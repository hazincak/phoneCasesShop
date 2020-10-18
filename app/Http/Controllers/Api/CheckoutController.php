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

        // dd($request);

        try {
            $charge = Stripe::charges()->create([
                'currency' => 'EUR',
                'source' => $request->data['id'],
                'amount'   => $request->price,
                'description' => 'Description goes here',
                'receipt_email' => $request->customer['email'],
                'metadata' => [
                    'data1' => 'metadata 1',
                    'data2' => 'metadata 2',
                    'data3' => 'metadata 3'
                ]
            ]);

            //save this data to database

            //SUCCESFUL
            return back()->with('success_message', 'Ďakujeme za Vašu objednávku. Urýchlene ju spracujeme a budeme Vás informovať o dátume expedície tovaru. Správa bude doručená do vašej mailovej schránky, ktorú ste uviedli pri registrácii objednávky.');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
