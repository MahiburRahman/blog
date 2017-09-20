<?php
    use Illuminate\Support\Facades\Auth;
    use App\Model\User;
    $asset = asset('/');
    if(Auth::user())
    {
        $userInfo = User::find(Auth::user()->id)->UserMeta;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{$asset}}css/bootstrap.min.css">
	<link rel="stylesheet" href="{{$asset}}css/main.css?h=hhs">
    <link rel="stylesheet" href="{{$asset}}css/telephonePlugin/intlTelInput.css">

    <link rel="stylesheet" href="{{$asset}}css/normalize.css">
    <link rel="stylesheet" href="{{$asset}}css/font-awesome.css">
    <link href='//fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    
    @yield('additional_css')

</head>
<body>
	<div class="page-content">
		<nav class="navbar navbar-default navbar-static-top">
            <div class="container"> 
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{route('home_page')}}">
                        <img id="SiteLogo" src="{{$asset}}images/white_logo.png" alt="logo" height="35px" width="220px" />                    
                    </a>
                </div> 
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav">                        
                        <ul class="nav navbar-nav">                        
                            <li class="dropdown">
                                <a href="{{route('home_page')}}"> <b>Home</b> 
                                </a>
                            </li>
                            @if( !Auth::user())
                            <li class="dropdown">
                                <a href="{{route('login_view')}}"> <b>Login</b>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{route('signup')}}"> <b>Sign Up</b>
                                </a>
                            </li>
                            @endif
                            @if( Auth::user())
                                <li class="dropdown">
                                    <a id="dLabel" role="button" data-toggle="dropdown" class="" data-target="#" href="#"><span class="" aria-hidden="true"></span> 
                                        <b>
                                            @if($userInfo)
                                                {{$userInfo->first_name}} {{$userInfo->last_name}}
                                            @endif
                                        </b>
                                    </a>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        <li><a href="{{route('profile_page')}}">Profile</a></li>
                                        <li><a href="{{route('my_posts')}}">Your Posts</a></li>
                                        <li><a href="{{route('new_post')}}">Add a new post</a></li>
                                        <li class="dropdown">
                                            <a href="{{route('logout')}}"> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif                            
                        </ul>                        
                    </ul>
                </div>
            </div>
    	</nav>

        <div class="container">
        	{{--<div class="col-md-offset-1 modal-body row">
		      <h1 id="logo-text"><a href="index.html" title="">Test Blog</a></h1>
				<p id="intro">Writing is the painting of the voice- Voltaire</p>
			</div>--}}
            <div class="col-md-offset-1 modal-body row">
                @if ( count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class='alert alert-success'>
                        {{Session::get('success')}}
                    </div>
                @endif
                @if(Session::has('unsuccess'))
                    <div class='alert alert-danger'>
                        {{Session::get('unsuccess')}}
                    </div>
                @endif
            </div>

        	<div class="col-md-offset-1 modal-body row">

			  <div class="col-md-9 page_verticalLine">
			    @yield('maincontent')
			  </div>
			  <div class="col-md-3">
			    <div class="Catagory">
			    	<h4>CATEGORIES</h4>
			    	<ul class="">
							<li><a class="text-color" href="{{route('category_search', ['id' =>'1'])}}">Life Style</a></li>
							<li><a class="text-color" href="{{route('category_search', ['id' =>'2'])}}">Fashion</a></li>
                            <li><a class="text-color" href="{{route('category_search', ['id' =>'3'])}}">Sports</a></li>
                            <li><a class="text-color" href="{{route('category_search', ['id' =>'4'])}}">Music</a></li>
                            <li><a class="text-color" href="{{route('category_search', ['id' =>'5'])}}">Health</a></li>
                            <li><a class="text-color" href="{{route('category_search', ['id' =>'6'])}}">Travel</a></li>
						</ul>
			    </div><br><br>


			    
			  </div>
			</div>
        </div>
    </div><br><br>
    <footer class="container footer">
      <div class="row">  
         <p class="text-center">&copy;Copyright Muhib Shakil-2017 .</p>
      </div>
   </footer>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{$asset}}js/vendor/jquery-1.12.1.min.js"><\/script>')</script>
    <script src="{{$asset}}js/bootstrap.min.js"></script>
    <script src="{{$asset}}js/telephonePlugin/intlTelInput.min.js"></script>
    <script src="{{$asset}}js/bootstrap.min.js"></script>  
    <script src="{{$asset}}js/vendor/modernizr-2.8.3.min.js"></script>   
    @yield('additional_js')
</body>
</html>