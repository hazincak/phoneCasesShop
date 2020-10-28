<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}

        <title>Laravel</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        {{-- Scripts --}}
        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="https://js.stripe.com/v3/"></script>
        {{-- <script src="https://www.paypal.com/sdk/js?client-id=ARW5P-eRi2sHOC2zpRo554FbOiZyUcFBPlMv8iJlWlrKCt43N21KijjGoi4jbCi2DVZItvsJ72VbHgEv"></script> --}}
    </head>
    <body>
        <div id="app">
            <index></index>
        </div>
    </body>
</html>
