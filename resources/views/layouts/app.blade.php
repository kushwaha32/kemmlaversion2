<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Basic Page Needs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KemmlaMart - Organic, Fresh Vegetable, Farm Store</title>
    
    <meta name="keywords" content="Organic, Fresh Vegetable, Farm Store">
    <meta name="description" content="KemmlaMart - Organic, Fresh Vegetable, Farm Store">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/img/favicon.png')}}" type="image/png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('frontend/libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/font-material/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/nivo-slider/css/nivo-slider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/nivo-slider/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/nivo-slider/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/owl.carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/libs/slider-range/css/jslider.css')}}">
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/reponsive.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('frontend/frontend.css')}}">
    
    
</head>
<body class="home home-4">
    <div id="all">
        @include('partials.header')
        <main id="content" class="site-content">
          <section class="section slideshow">
            @yield('content')
          </section>
          @include('partials.footer')
        </main>
      
    </div>



    <!-- Vendor JS -->
		<script src="{{asset('frontend/libs/jquery/jquery.js')}}"></script>
		<script src="{{asset('frontend/libs/bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{asset('frontend/libs/jquery.countdown/jquery.countdown.js')}}"></script>
		<script src="{{asset('frontend/libs/nivo-slider/js/jquery.nivo.slider.js')}}"></script>
		<script src="{{asset('frontend/libs/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('frontend/libs/slider-range/js/tmpl.js')}}"></script>
		<script src="{{asset('frontend/libs/slider-range/js/jquery.dependClass-0.1.js')}}"></script>
		<script src="{{asset('frontend/libs/slider-range/js/draggable-0.1.js')}}"></script>
		<script src="{{asset('frontend/libs/slider-range/js/jquery.slider.js')}}"></script>
		<script src="{{asset('frontend/libs/elevatezoom/jquery.elevatezoom.js')}}"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<!-- Template CSS -->
		<script src="{{asset('frontend/js/main.js')}}"></script>
    @yield('productJs')
</body>
</html>
