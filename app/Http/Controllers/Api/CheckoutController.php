<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Orders;
use App\OrdersProducts;
use App\Traits\CreateUserTrait;
use App\Traits\StoreOrderTrait;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
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

        dd($user->email);
        try {
            //Storing user to Stripe payment gateway
            // $customer = Stripe::customers()->create([
            // 'name' =>  $customersFullName,
            // 'email' => $validated['customer']['email'],
            // 'phone' => $validated['customer']['phone_number'],
            // 'address' => [
            //     'line1' => $user->street,
            //     'city' => $validated['customer']['city'],
            //     'postal_code' => $validated['customer']['zip'],
            //     ],
            // ]);


            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->priceBreakdown['calculatedTotalPrice'],
                'receipt_email' => $request->customer['email'],
                'metadata' => [
                    'Meno a priezvisko' => $customersFullName ,
                    'Email' => $user->email,
                    'Telefónne číslo' => $user->phone_number,
                    'Adresa' => $request->customer['street'],
                    'Mesto' => $request->customer['city'],
                    'Poštové smerovacie čísla' => $request->customer['zip'],
                    'Kraj' => $request->customer['county'],
                    'číslo objednávky' => ''
                ]
            ]);

            $order = $this->storeOrder($request->priceBreakdown, $request->basket, $user);
            
        
            $updatedCharge = Stripe::charges()->update($charge['id'], [
                'metadata' =>[
                    'Číslo objednávky' => $order->id,
                ] 
            ]);
        
            //after saving to database update $charge metadata with the order id

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
        
        

        // try {
            $user = User::create([
                'first_name' => $validated['customer']['first_name'],
                'last_name' => $validated['customer']['last_name'],
                'street' => $customerFullStreetName,
                'phone_number' => $validated['customer']['phone_number'],
                'city' => $validated['customer']['city'],
                'county' => $validated['customer']['county'],
                'zip' => $validated['customer']['zip'],
                'email' => $validated['customer']['email'],
            ]);
        // } catch (QueryException $e) {
        //     $user = User::where('email', $validated['customer']['email'])->firstOrFail();
        //     $user->update([
        //         'first_name' => $validated['customer']['first_name'],
        //         'last_name' => $validated['customer']['last_name'],
        //         'street' => $customerFullStreetName,
        //         'city' => $validated['customer']['city'],
        //         'county' => $validated['customer']['county'],
        //         'zip' => $validated['customer']['zip'],
        //         'phone_number' => $validated['customer']['phone_number'],
        //     ]);
        // }

        $order = Orders::create([
            'user_id' => $user->id,
            'payment_method' => $request->priceBreakdown['paymentMethod'],
            'delivery_method' => $request->priceBreakdown['deliveryMethod'],
            'total_price' => $request->priceBreakdown['calculatedTotalPrice'],  
        ]);

        

        for($index = 0; $index <= $basketLength-1; $index++){
            OrdersProducts::create([
                'order_id' => $order->id,
                'product_id' => Arr::get($collapsedArray, "{$index}.product.id"),
                'product_title' =>  Arr::get($collapsedArray, "{$index}.product.title"),   
            ]);
        }         

        //send Email
    }

    
}
