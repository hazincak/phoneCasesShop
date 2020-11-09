<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f5f5fa;
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



</style>
<div>
    <h1 style="margin: auto">LOGO</h1>
    <h3>Dobrý deň,</h3>

    <p>Potvrdzujeme prijatie Vašej objednávky z {{$order->created_at}} a posielame zhrnutie.</p>

    <h3>Kontaktné údaje a adresa príjemcu</h3>
    <table style="width:100%">
        <tr>
            <th>Meno a priezvisko</th>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
        </tr>
        <tr>
            <th>E-mailová adresa</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Telefónne číslo</th>
            <td>{{$user->phone_number}}</td>
        </tr>
        <tr>
            <th>Ulica</th>
            <td>{{$user->street}}</td>
        </tr>
        <tr>
            <th>Mesto</th>
            <td>{{$user->city}}</td>
        </tr>
        <tr>
            <th>Kraj</th>
            <td>{{$user->county}}</td>
        </tr>
        <tr>
            <th>Poštové smerovacie číslo</th>
            <td>{{$user->zip}}</td>
        </tr>
      </table>
      <h3>Spôsob platby a doručenia</h3>
      <table style="width:100%">
        <tr>
            <th>Spôsob platby</th>
            <td>{{$order->payment_method}}</td>
        </tr>
        <tr>
            <th>Spôsob doručenia</th>
            <td>{{$order->delivery_method}}</td>
        </tr> 
      </table>
      <h3>Obsah objednávky</h3>
      <table style="width:100%">
        <tr>
            <th>#</th>
            <th>Popis produktu</th>
            <th>Cena</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$product->product_title}}</td>
                <td>€{{$product->product_price}}</td>
            </tr>
        @endforeach
      </table>
      <h3>Obsah objednávky</h3>
      <table style="width:100%">
        <tr>
            <th>#</th>
            <th>Popis produktu</th>
            <th>Cena</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$product->product_title}}</td>
                <td>€{{$product->product_price}}</td>
            </tr>
        @endforeach
      </table>

      <h3>Výpočet ceny</h3>
      <table style="width:100%">
        <tr>
            <th>Doprava</th>
            <td>
                @if($deliveryFee === 0) 
                 ZADARMO
                @else
                €{{$deliveryFee}}
                @endIF
            </td>
        </tr>
        <tr>
            <th>Cena spolu</th>
            <td>€{{$order->total_price}}</td>
        </tr>
      </table>
</div>


