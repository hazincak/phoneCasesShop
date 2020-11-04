<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Order;
use App\OrdersProducts;
use App\Mail\ConfirmOrder;
use Illuminate\Support\Arr;
use App\Traits\CreateUserTrait;
use App\Traits\StoreOrderTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Requests\CheckoutUserValidation;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{

    use CreateUserTrait;
    use StoreOrderTrait;

    public function stripeCheckout(CheckoutUserValidation $request){

        //validation
        $validated = $request->validated();
        $customersFullName = $validated['customer']['first_name'] . ' ' . $validated['customer']['last_name'];
        //Storing user to my database        
        $user = $this->createUser($validated);

        try {
            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->priceBreakdown['calculatedTotalPrice'],
                'receipt_email' => $request->customer['email'],
                'metadata' => [
                    'Meno a priezvisko' => $customersFullName ,
                    'Email' => $user->email,
                    'Telefónne číslo' => $user->phone_number,
                    'Adresa' => $user->street,
                    'Mesto' => $user->city,
                    'Poštové smerovacie čísla' => $user->zip,
                    'Kraj' => $user->county,
                    'číslo objednávky' => ''
                ]
            ]);

            $order = $this->storeOrder($request->priceBreakdown, $request->basket, $user);
            
        
            $updatedCharge = Stripe::charges()->update($charge['id'], [
                'metadata' =>[
                    'Číslo objednávky' => $order->id,
                ] 
            ]);
            
            //send Email

            //SUCCESFUL
            return response()->json([
                'status' => 'success',
            ], 201);
        } catch (CardErrorException $e) {
            if($e->getMessage() === 'Your card has insufficient funds.'){
                return response()->json([
                    'errors' => 'Nedostatok prostriedkov na účte.',
                ], 422);
            }else if($e->getMessage() === 'Your card has expired.'){
                return response()->json([
                    'errors' => 'Platobná karta je expirovaná.',
                ], 422);
            }else if($e->getMessage() === "Your card's security code is incorrect."){
                return response()->json([
                    'errors' => 'Nesprávny CVV/CVC kód (číslo na zadnej strane platobnej/kreditnej karty).',
                ], 422);
            }else if ($e->getMessage() === 'Your card was declined.'){
                return response()->json([
                    'errors' => 'Vaša platba bola zamietnutá. Prosím použite inú kartu',
                ], 422);
            }
        }

    }

    public function checkout(CheckoutUserValidation $request){
        $validated = $request->validated();
        $collapsedArray = Arr::dot($request->basket);
        $basketLength = count($request->basket);  
        $customerFullStreetName = $validated['customer']['street_name'] . ' ' . $validated['customer']['street_number'];
        
        $user = $this->createUser($validated);

        $order = $this->storeOrder($request->priceBreakdown, $request->basket, $user);

        //send Email
       
        // dd($email);
        // dd($order);

        $products = Order::find($order->id)->ordersProducts;
      
        
        Mail::to($user->email)->send(
            new ConfirmOrder($user, $order, $products)
        );

        return response()->json([
            'status' => 'success',
        ], 201);
        

        
    }

    
}
