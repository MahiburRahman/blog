@extends('master.master_without_footer')
<?php
  $asset = asset('/');
?>
@section('maincontent')

<h3>Sign Up</h3>
<div class="login-box-inner">
    <form  action="{{route('save_signup')}}" method="POST" role="form" class="form-horizontal" id="pd_forms" enctype="multipart/form-data">
    {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
            <input type="text" name="first_name" class="form-control e" placeholder="First name" value="{{ old('first_name') }}" required autofocus>
            @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
            <input type="text" name="last_name" class="form-control e" placeholder="Last name" value="{{ old('last_name') }}" required autofocus>
            @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" class="form-control e" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            <input type="hidden" id="countryCode" name="countryCode" value="{{ old('countryCode') }}">
            <input type="hidden" id="iso2" name="iso2" value="{{ old('iso2') }}">
            <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="form-control p" placeholder="" >
            <span id="valid-msg" class="hide"><i class="fa fa-check" aria-hidden="true"></i> Valid</span>
            <span id="error-msg" class="hide"><i class="fa fa-times" aria-hidden="true"></i> Invalid</span>
            @if ($errors->has('phone_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
            <input id="confirm_password" type="password" name="confirm_password" class="form-control p" placeholder="Confirm password" required>
            @if ($errors->has('confirm_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('confirm_password') }}</strong>
                </span>
            @endif
        </div>   
 
        <div class="form-group">
            <div class="text-right">
                <button type="submit" class="btn btn-submit-continue" id="save_pd_btn">Create Account</button>
            </div>
        </div>
    </form>
    <a href="{{route('login_view')}}" class="pull-left">Login</a>
    <a href="{{route('home_page')}}" class="pull-right">Home</a>
</div>
@stop

@section('additional_js')
<script>
    $(document).ready(function() {
        $("#save_pd_btn").click(function(e) {
            e.preventDefault();
            var codeNo = $("#phone_number").intlTelInput("getSelectedCountryData");
            var iso2 = codeNo.iso2;

            var dialNo = codeNo.dialCode;
            dialNo = '+' + dialNo;
            $("#countryCode").val(dialNo);
            $("#iso2").val(iso2);
            $("#pd_forms").submit();
        });
        var telInput = $("#phone_number")
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");
        var initCountry = $("#iso2").val();
        if (initCountry == "")
            initCountry = "bd";
        // initialise plugin
        telInput.intlTelInput({
            preferredCountries: ["bd"],
            initialCountry: initCountry,
            utilsScript: "{{$asset}}js/telephonePlugin/utils.js",
        });
        var reset = function() {
            telInput.removeClass("error");
            errorMsg.addClass("hide");
            validMsg.addClass("hide");
        };
        
        telInput.blur(function () {
            //e.preventDefault();
            var str = telInput.val().replace(/[\s\-]+/g,'');
            
            if ($.isNumeric(str) == false || telInput.intlTelInput("isValidNumber") == false) {
                errorMsg.removeClass("hide");
                $('#save_pd_btn').attr('disabled',true);
            }else{
                validMsg.removeClass("hide");
                $('#save_pd_btn').attr('disabled',false);
            }
        });
        // on keyup / change flag: reset
        telInput.on("keyup change", reset);
    });
</script>
@stop