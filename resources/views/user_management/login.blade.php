@extends('master.master_without_footer')
@section('maincontent')

<h3>Login</h3>
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

<div class="login-box-inner">
    <form  action="{{route('post_login')}}" method="POST" role="form" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="text" name="email" class="form-control e" placeholder="Email" autofocus >
           
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" name="password" class="form-control p" placeholder="Password" >
            
        </div>
        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-submit-continue">Login</button>
            </div>
        </div>
    </form>
    <a href="{{route('signup')}}" class="pull-left">Sign Up</a>
    <a href="{{route('home_page')}}" class="pull-right">Home</a>
</div>
@stop