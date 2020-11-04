<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<h1>LOGO</h1>
<h3>Dobrý deň,</h3>

<p>Potvrdzujeme prijatie Vašej objednávky a posielame zhrnutie.</p>
<h3>User</h3>
<p>{{$user->first_name}}</p>
<p>{{$user->last_name}}</p>
<p>{{$user->street}}</p>
<p>{{$user->city}}</p>
<p>{{$user->county}}</p>
<p>{{$user->phone_number}}</p>
<p>{{$user->zip}}</p>
<h3>Order</h3>
<p>{{$order->payment_method}}</p>
<p>{{$order->delivery_method}}</p>
<p>{{$order->total_price}}</p>
<p>{{$order->created_at}}</p>
<h3>Order items</h3>
@foreach ($products as $product)
    <p>{{ $product->product_title }}</p>
@endforeach



