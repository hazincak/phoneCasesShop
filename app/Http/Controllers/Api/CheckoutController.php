<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Traits\CreateUserTrait;
use App\Traits\StoreOrderTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Requests\CheckoutUserValidation;
use App\Mail\OrderReceived;
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
                    'Full name' => $customersFullName ,
                    'Email' => $user->email,
                    'Phone number' => $user->phone_number,
                    'Address' => $user->street,
                    'City' => $user->city,
                    'Eircode' => $user->zip,
                    'County' => $user->county,
                    'Order number' => ''
                ]
            ]);

            $order = $this->storeOrder($request->priceBreakdown, $request->basket, $user);


            $updatedCharge = Stripe::charges()->update($charge['id'], [
                'metadata' =>[
                    'Order number' => $order->id,
                ]
            ]);

            $products = Order::find($order->id)->ordersProducts;

            Mail::to($user->email)->send(
                new OrderReceived($user, $order, $products, $request->priceBreakdown['deliveryFee'])
            );

            //SUCCESFUL
            return response()->json([
                'status' => 'success',
            ], 201);
        } catch (CardErrorException $e) {

            return response()->json([
                'errors' => $e->getMessage()
            ], 422);
        }

    }

    public function checkout(CheckoutUserValidation $request){
        $validated = $request->validated();

        $customerFullStreetName = $validated['customer']['street_name'] . ' ' . $validated['customer']['street_number'];

        $user = $this->createUser($validated);

        $order = $this->storeOrder($request->priceBreakdown, $request->basket, $user);

        $products = Order::find($order->id)->ordersProducts;


        Mail::to($user->email)->send(
            new OrderReceived($user, $order, $products, $request->priceBreakdown['deliveryFee'])
        );

        return response()->json([
            'status' => 'success',
        ], 201);



    }


}
