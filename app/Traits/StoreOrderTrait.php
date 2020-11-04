<?php

namespace App\Traits;

use App\Order;
use App\OrdersProducts;
use Illuminate\Support\Arr;



trait StoreOrderTrait{
    
    public function storeOrder($priceBreakdown, $basket, $user){
        $basketLength = count($basket);
        $collapsedArray = Arr::dot($basket);


        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $priceBreakdown['paymentMethod'],
            'delivery_method' => $priceBreakdown['deliveryMethod'],
            'total_price' => $priceBreakdown['calculatedTotalPrice'],  
        ]);

        

        for($index = 0; $index <= $basketLength-1; $index++){
            OrdersProducts::create([
                'order_id' => $order->id,
                'product_id' => Arr::get($collapsedArray, "{$index}.product.id"),
                'product_title' =>  Arr::get($collapsedArray, "{$index}.product.title"),   
            ]);
        }
        
        return $order;
    }
}