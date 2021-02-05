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
use App\User;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Mockery\Undefined;

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

            return response()->json([
                'status' => 'success',
            ], 201);
        } catch (CardErrorException $e) {

            return response()->json([
                'errors' => $e->getMessage()
            ], 422);
        }

    }

    public function payPalCheckout(Request $request){

        try{
            $user = User::create([
                'first_name' => $request['customer']['first_name'],
                'last_name' => $request['customer']['last_name'],
                'street' => $request['customer']['street_name'],
                'city' => $request['customer']['city'],
                'county' => 'undefined',
                'zip' => $request['customer']['zip'],
                'email' => $request['customer']['email'],
                'phone_number' => $request['customer']['phone_number']
            ]);
        }  catch (QueryException $e) {
                $user = User::where('email', $request['customer']['email'])->firstOrFail();
                $user->update([
                    'first_name' => $request['customer']['first_name'],
                    'last_name' => $request['customer']['last_name'],
                    'street' => $request['customer']['street_name'],
                    'city' => $request['customer']['city'],
                    'county' => 'undefined',
                    'zip' => $request['customer']['zip'],
                    'phone_number' => $request['customer']['phone_number']
            ]);
        }


        $order = $this->storeOrder($request['priceBreakdown'], $request['basket'], $user);

        $products = Order::find($order->id)->ordersProducts;

        Mail::to($user->email)->send(
            new OrderReceived($user, $order, $products, $request->priceBreakdown['deliveryFee'])
        );

        return response()->json([
            'status' => 'success',
        ], 201);
    }

    public function checkout(CheckoutUserValidation $request){
        $validated = $request->validated();

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
