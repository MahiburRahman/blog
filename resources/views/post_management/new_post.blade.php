@extends('master.master_with_footer')
@section('maincontent')
	<form action="{{route('save_new_post')}}"  method="POST" role="form" class="form-horizontal" id="pd_forms" enctype="multipart/form-data">
	    {!! csrf_field() !!}
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label class="col-md-2">Title</label>
	            <div class="col-md-10">
	                <input type="text" name="title" placeholder="Title" class="form-control" value="{{ old('title') }}">
		            @if ($errors->has('title'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('title') }}</strong>
		                </span>
		            @endif
	            </div>
			</div>
			<div class="form-group">
				<label class="col-md-2">Category</label>
	            <div class="col-md-10">
		            <div class="f_select">
		            	<select name="category" class="form-control">
							<option value="1">Life Style</option>
							<option value="2">Fashion</option>
							<option value="3">Sports</option>
							<option value="4">Music</option>
							<option value="5">Health</option>
							<option value="6">Travel</option>
		                </select>
		            </div>
	            </div>
			</div>
			<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
				<label class="col-md-2">Post Text</label>
	            <div class="col-md-10">
	                <textarea name="text" class="form-control" placeholder="Your text" value="{{ old('text') }}"  id="text" rows="15" cols="84" ></textarea>
		            @if ($errors->has('text'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('text') }}</strong>
		                </span>
		            @endif
	            </div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10 ">
					<button type="submit" class="btn btn-primary  form-control" id=""><i class="fa fa-floppy-o"></i> Save</button>
				</div>
			</div>
	</form>
@stop