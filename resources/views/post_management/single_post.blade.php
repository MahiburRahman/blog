@extends('master.master_with_footer')
<?php
    use Illuminate\Support\Facades\Auth;
?>
@section('maincontent')
	<article class="">
		<h2 class="">
			<p class="text-color">{{$post->title}}</p>
		</h2> 				 
		<div class="">
			<ul class="post_time_ul">
				<li class="post_time_li"><b>{{$post->created_at->format('h:ia d/m/Y')}} by </b></li>
				<li class="post_time_li"><b>{{$post->user->UserMeta->first_name or ''}} {{$post->user->UserMeta->last_name or ''}}</b></li>
			</ul>
		</div> 					 				
		<div class="">
			<?php echo nl2br($post->text); ?>
		</div><br><br>
	</article>

	@if(count($comments)>0)
		<div>
			<h4><b> {{count($comments)}} Comments</b></h4>  
			@foreach($comments as $aComment)       
		        <div class="">
		            <cite><b>{{$aComment->name}}</b></cite>
		            <div class="">
		               {{$aComment->created_at->format('h:ia d/m/Y')}}
		            </div>
		        </div>
		        <div class="">
		            <p>{{$aComment->text}}</p>
		        </div>   
			   @endforeach
		</div><br>
	@endif

	 <div class="">
	  	<h4><b>Leave a Comment </b></h4>
	  	<form name="" id="" method="post" action="{{route('save_comment', ['id'=>$post->id])}}" enctype="multipart/form-data">
	  	{!! csrf_field() !!}	
		     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label class="col-md-2">Your Name *</label>
		        <div class="col-md-10">
		        	@if(Auth::user())
		            <input type="text" name="name" class="form-control" value="{{$auth->UserMeta->first_name}} {{$auth->UserMeta->last_name}}" placeholder="Your name" readonly="">
		            @else
		            <input type="text" name="name" class="form-control" value="" placeholder="Your name">
		            @endif
		        </div>
			</div><br><br>

			<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
				<label class="col-md-2">Comment *</label>
		        <div class="col-md-10">
		            <textarea name="comment" class="form-control" placeholder="Your comment" id="comment" rows="8" cols="82" ></textarea>
		        </div>
			</div><br><br>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10 ">
					<button type="submit" class="btn btn-primary form-control">Submit</button>
				</div>
			</div>			
		</form> 
	</div>
@stop