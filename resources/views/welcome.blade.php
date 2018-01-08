<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <script>
          var keyhash = {
            key: "{{ config('services.stripe.key') }}"
          };
        </script>

    </head>
    <body>
        <h1>Buy My Book for $25.00</h1>

        <div id="app">
            <checkout-form :products="{{ $products }}"></checkout-form>
        </div>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
