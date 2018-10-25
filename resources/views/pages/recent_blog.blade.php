@extends('master')
@section('recent_blog')

	<h4>Recent Post</h4>
	<ul class="templatemo_list">
	    @foreach($recent_blog as $blog)
	    <li><a href="{{ URL::to('/blog-detail/'.$blog->blog_id) }}">{{ $blog->blog_title }}</a></li>
	    @endforeach
	</ul>
@endsection