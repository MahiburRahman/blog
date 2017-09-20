@extends('master.master_with_footer')
<?php
    $asset = asset('/');
?>

@section('maincontent')
<form action="save_profile"  method="POST" role="form" class="form-horizontal" id="pd_forms" enctype="multipart/form-data">
    {!! csrf_field() !!}
	<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
		<label class="col-md-3">First Name</label>
        <div class="col-md-5">
            <input type="text" name="first_name" value="{{$auth->UserMeta->first_name}}" placeholder="First name" class="form-control"">
        </div>
	</div>
	<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
		<label class="col-md-3">Last Name</label>
        <div class="col-md-5">
            <input type="text" name="last_name" placeholder="Last name" class="form-control"  value="{{$auth->UserMeta->last_name}}">
        </div>
	</div>
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<label class="col-md-3">Email</label>
        <div class="col-md-5">
            <input type="email" name="email" placeholder="email" class="form-control"  value="{{$auth->email}}">
        </div>
	</div>
	<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
		<label class="col-md-3">Phone</label>
        <div class="col-md-5">
            <input type="hidden" id="countryCode" name="countryCode"  value="{{$auth->UserMeta->country_phone_code}}">
            <input type="hidden" id="iso2" name="iso2" value="{{$auth->UserMeta->country_iso2_code}}">
            <input type="tel" id="phone_number" name="phone_number"  value="{{$auth->UserMeta->phone}}" class="form-control" placeholder="" >
            <span id="valid-msg" class="hide"><i class="fa fa-check" aria-hidden="true"></i> Valid</span>
            <span id="error-msg" class="hide"><i class="fa fa-times" aria-hidden="true"></i> Invalid</span>
        </div>
	</div>
	<div class="form-group">
        <div class="col-md-5 col-md-offset-3">
            <button type="submit" class="btn btn-primary" id="save_pd_btn"><i class="fa fa-floppy-o"></i> Save</button>
        </div>
    </div>
</form>
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