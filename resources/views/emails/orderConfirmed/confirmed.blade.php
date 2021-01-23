<style>
     body{
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f5f5fa;
    }

    .row{
        width: 100%;
        height: 80px;
        margin-bottom: 10px;
        background-color: #01a9b4;
        text-align:center
    }


    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }


    table tr {
      background-color: #f8f8f8;
      border: 1px solid #ddd;
      padding: .35em;
    }

    table th,
    table td {
      padding: .625em;
      text-align: left;
    }

    table th {
      font-size: .85em;
      letter-spacing: .1em;
      text-transform: uppercase;
    }

    .row{
        width: 100%;
        height: 80px;
        margin-bottom: 10px;
        background-color: #333;
        text-align:center
}

    .navbar-brand{
        width: 240px;
    }
</style>
<div>
    <div class="row">
        <img class="navbar-brand" src="{{asset('images/logo.svg')}}">
    </div>

    <h2>Thanks {{$user->first_name}}, your order is confirmed and it's on the way. </h2>

    <p>You can expect it within 72 hours.</p>

    <h3>Contact details</h3>
    <table style="width:100%">
        <tr>
            <th>Full name</th>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Phone number</th>
            <td>{{$user->phone_number}}</td>
        </tr>
        <tr>
            <th>Street</th>
            <td>{{$user->street}}</td>
        </tr>
        <tr>
            <th>City</th>
            <td>{{$user->city}}</td>
        </tr>
        <tr>
            <th>County</th>
            <td>{{$user->county}}</td>
        </tr>
        <tr>
            <th>Eircode</th>
            <td>{{$user->zip}}</td>
        </tr>
      </table>
      <h3>Your order</h3>
      <table style="width:100%">
        <tr>
            <th>#</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$product->product_title}}</td>
                <td>€{{$product->product_price}}</td>
            </tr>
        @endforeach
      </table>

      <h3>Price breakdown</h3>
      <table style="width:100%">
        <tr>
            <th>Total price</th>
            <td>€{{$order->total_price}}</td>
        </tr>
      </table>
</div>
