<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}

        <title>MobilePhoneCasesEshop</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        {{-- Scripts --}}
        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="https://js.stripe.com/v3/"></script>
    </head>
    <body>
        <div id="app">
            <index></index>
        </div>
    </body>
</html>
