<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function stripeCheckout(Request $request){

        //validation
        dd($request->basket);
        dd($request);

        $customersFullName = $request->customer['first_name'] . ' ' . $request->customer['last_name'];

        try {
            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->price,
                
                // for($request->basket as $product){

                // }
                'description' => 'Description goes here',
                
                'receipt_email' => $request->customer['email'],
                'metadata' => [
                    'Meno a priezvisko' => $customersFullName ,
                    'Email' => $request->customer['email'],
                    'Telefónne číslo' => 'metadata 3',
                    'Adresa' => $request->customer['street'],
                    'Mesto' => $request->customer['city'],
                    'Poštové smerovacie čísla' => $request->customer['zip'],
                    'Kraj' => $request->customer['county']
                ]
            ]);

            //save this data to database

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
}
