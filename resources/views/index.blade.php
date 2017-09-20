@extends('master.master_with_footer')
@section('maincontent')
	@if(count($allPost)>0)
		@foreach($allPost as $aPost)
			<article class="">
				<h2 class="">
					<a class="text-color" href="{{route('single_post', $aPost->title)}}">{{$aPost->title or ''}}</a>
				</h2> 				 
				<div class="">
					<ul class="post_time_ul">
						<li class="post_time_li"><b>{{$aPost->created_at->format('h:ia d/m/Y')}} by </b></li>
						<li class="post_time_li"><b>{{$aPost->user->UserMeta->first_name or ''}} {{$aPost->user->UserMeta->last_name or ''}}</b></li>
					</ul>
				</div> 					 				
				<div class="">
					@if(strlen($aPost->text)>1000)
						{{mb_substr($aPost->text, 0, 1000)}}...
					@else
						<p>{{$aPost->text or ''}}</p>
					@endif
					
				</div> 
			</article>
		@endforeach

		<div class="pull-left">
			{{ $allPost->links() }}
		</div>
	@else
		<div class="alert alert-danger text-center">There is no post</div>
	@endif
@stop