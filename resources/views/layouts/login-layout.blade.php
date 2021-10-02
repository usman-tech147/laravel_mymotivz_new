<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <title>MyMotivz | @yield('title')</title>

    <!-- Css Files -->
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" type="image/png" />
    <link href="{{ asset('user/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/slick-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/t-scroll.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/responsive.css') }}" rel="stylesheet">
  </head>
  <body>
	
    <!--// Main Wrapper \\-->
    <div class="motivz-main-wrapper">

		<!--// Main Content \\-->
		  @yield('content')
		<!--// Main Content \\-->

	<div class="clearfix"></div>
    </div>
    <!--// Main Wrapper \\-->


	<!-- jQuery (necessary for JavaScript plugins) -->
	<script type="text/javascript" src="{{ asset('user/script/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/script/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets\scripts\jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets\scripts\additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/script/slick.slider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/script/t-scroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/script/functions.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('user/script/login-custom.js') }}"></script> -->
@yield('script')

  </body>
</html>