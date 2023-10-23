<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_assets/images/favicon.png')}}">

    <!-- Page Title -->
    <title>{{$setting->project_name}}</title>

    <!-- * INFO: ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!--* INFO: Google FONTS (MONTSERRAT) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <style>
        .audio{
            display: flex;
            justify-content: center;
            height: 100vh;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="audio">
    <audio controls autoplay>
        <source src="{{asset($qr_codes->image)}}" type="audio/ogg">
        <source src="{{asset($qr_codes->image)}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>


<!-- For Js Library -->
<script src="{{asset('front_assets/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('front_assets/js/main.js')}}"></script>
<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>
</html>

