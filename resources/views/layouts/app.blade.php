<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="{{ URL::to('/public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{!! URL::to('/public/assets/css/style.css') !!}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>
<body>
    @yield('content')

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sp-pnp-js/2.0.0/pnp.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{!! URL::to('/public/assets/js/jquery.min.js') !!}"></script>
        <!-- Bootstrap -->
  <script src="{!! URL::to('/public/assets/js/bootstrap.min.js') !!}"></script>
  <!-- Inview -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{!! URL::to('/public/assets/js/jquery.js') !!}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>


       