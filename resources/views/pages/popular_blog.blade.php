@extends('master')
@section('popular_blog')
<?php

$popular_blog = DB::table('tbl_blog')
				->orderBy('hit_count','Desc')
				->limit(3)
				->get();


?>

	<h4>Popular Post</h4>
	<ul class="templatemo_list">
	    @foreach($popular_blog as $blog)
	    <li><a href="{{ URL::to('/blog-detail/'.$blog->blog_id) }}">{{ $blog->blog_title }} {{ "(" . $blog->hit_count .")" }}</a></li>
	    @endforeach
	</ul>
@endsection