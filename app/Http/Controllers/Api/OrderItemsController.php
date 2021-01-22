<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    public function getOrderItems($id){
        $order = Order::findOrFail($id);
        $orderItems = $order->ordersProducts;
        return $orderItems;
    }
}
