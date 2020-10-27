<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Orders;
use App\OrdersProducts;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Requests\CheckoutUserValidation;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    public function stripeCheckout(CheckoutUserValidation $request){

        //validation
        $validated = $request->validated();
        $customersFullName = $validated['customer']['first_name'] . ' ' . $validated['customer']['last_name'];
        $customerFullStreetName = $validated['customer']['street_name'] . ' ' . $validated['customer']['street_number'];
        $customersFullAdress[] = $customerFullStreetName . ', ' . $validated['customer']['city'] . ', ' .  $validated['customer']['zip'] . ', ' . $validated['customer']['county'];
        
        // $collapsedArray = Arr::dot($request->basket);
        // $basketLength = count($request->basket);       
        // $basketItems[] = null;
        // $output = '';

        // for($index = 0; $index <= $basketLength-1; $index++){
            
        //     $basketItems[$index]['Produkt ID'] = Arr::get($collapsedArray, "{$index}.product.id");
        //     $basketItems[$index]['Názov produktu'] = Arr::get($collapsedArray, "{$index}.product.title");
        //     $basketItems[$index]['Cena produktu'] = Arr::get($collapsedArray, "{$index}.product.price");

        //     $output .= implode(', ', array_map(
        //         function ($v, $k) {
        //             if(is_array($v)){
        //                 return $k.'[]='.implode('&'.$k.'[]=', $v);
        //             }else{
        //                 return $k.' = '.$v;
        //             }
        //         }, 
        //         $basketItems[$index], 
        //         array_keys($basketItems[$index])
        //     ));

        // };
        try {
            

            $customer = Stripe::customers()->create([
            'name' =>  $customersFullName,
            'email' => $validated['customer']['email'],
            'phone' => $validated['customer']['phone_number'],
            'address' => [
                'line1' => $customerFullStreetName,
                'city' => $validated['customer']['city'],
                'postal_code' => $validated['customer']['zip'],
            ],
        ]);

            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->price['calculatedTotalPrice'],
                // 'description' => $output,
                'receipt_email' => $request->customer['email'],
                'metadata' => [
                    'Meno a priezvisko' => $customersFullName ,
                    'Email' => $validated['customer']['email'],
                    'Telefónne číslo' => $validated['customer']['phone_number'],
                    'Názov a a číslo ulice' => $customerFullStreetName,
                    'Mesto' => $validated['customer']['city'],
                    'Poštové smerovacie čísla' => $validated['customer']['zip'],
                    'Kraj' => $validated['customer']['county']
                ]
            ]);
            
            

            //save this data to database

            //after saving to database update $charge metadata with the order id

            //SUCCESFUL
            return response()->json([
                'status' => 'success',
            ], 201);
        } catch (CardErrorException $e) {
            // dd($e->getMessage());
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
       

        try {
            $user = User::create([
                'first_name' => $validated['customer']['first_name'],
                'last_name' => $validated['customer']['last_name'],
                'street' => $customerFullStreetName,
                'city' => $validated['customer']['city'],
                'county' => $validated['customer']['county'],
                'zip' => $validated['customer']['zip'],
                'email' => $validated['customer']['email'],
            ]);
        } catch (QueryException $e) {
            $user = User::where('email', $validated['customer']['email'])->firstOrFail();
            $user->update([
                'first_name' => $validated['customer']['first_name'],
                'last_name' => $validated['customer']['last_name'],
                'street' => $customerFullStreetName,
                'city' => $validated['customer']['city'],
                'county' => $validated['customer']['county'],
                'zip' => $validated['customer']['zip'],
                'email' => $validated['customer']['email'],
            ]);
        }

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


        

        
    

         
    }

    
}
