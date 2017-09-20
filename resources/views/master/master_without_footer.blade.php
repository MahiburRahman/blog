<?php
    $asset = asset('/');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{$asset}}css/bootstrap.min.css">    
    <link rel="stylesheet" href="{{$asset}}css/telephonePlugin/intlTelInput.css">
	<link rel="stylesheet" href="{{$asset}}css/main.css?h=hhs">
    <link rel="stylesheet" href="{{$asset}}css/normalize.css">
    <link rel="stylesheet" href="{{$asset}}css/font-awesome.css">
    <link href='//fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

    @yield('additional_css')

</head>
<body>
	<div class="page-content">
		
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4 ">
                    <div class="login-box">
                        <div class="login-box-header">
                            <img class="logo_property" src='{{$asset}}images/black_logo.png' height="70px" width="300px" alt=''>
                        </div>

                        @yield('maincontent')

                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{$asset}}js/vendor/jquery-1.12.1.min.js"><\/script>')</script>
    <script src="{{$asset}}js/bootstrap.min.js"></script>
    <script src="{{$asset}}js/telephonePlugin/intlTelInput.min.js"></script>
    <script src="{{$asset}}js/vendor/modernizr-2.8.3.min.js"></script>
    
    @yield('additional_js')

</body>
</html>