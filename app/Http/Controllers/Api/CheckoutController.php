<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    public function stripeCheckout(Request $request){

        //validation

        $customersFullName = $request->customer['first_name'] . ' ' . $request->customer['last_name'];
        

        $collapsedArray = Arr::dot($request->basket);
        $basketLength = count($request->basket);       
        $basketItems[] = null;
        $output = '';

        for($index = 0; $index <= $basketLength-1; $index++){
            
            $basketItems[$index]['Produkt ID'] = Arr::get($collapsedArray, "{$index}.product.id");
            $basketItems[$index]['Názov produktu'] = Arr::get($collapsedArray, "{$index}.product.title");
            $basketItems[$index]['Cena produktu'] = Arr::get($collapsedArray, "{$index}.product.price");

            $output .= implode(', ', array_map(
                function ($v, $k) {
                    if(is_array($v)){
                        return $k.'[]='.implode('&'.$k.'[]=', $v);
                    }else{
                        return $k.' = '.$v;
                    }
                }, 
                $basketItems[$index], 
                array_keys($basketItems[$index])
            ));

        };

        

        // dd($output);
        // dd($request->price);
        try {
            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->price['calculatedTotalPrice'],
                'description' => $output,
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
