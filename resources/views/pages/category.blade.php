@extends('master')
@section('category')

    <h4>Categories</h4>
    <ul class="templatemo_list">
    	<?php

    	 ?>
    	@foreach($cat as $category)
        <li><a href="{{ URL::to('/category-blog/'.$category->category_id) }}">{{ $category->category_name }}</a></li>
        @endforeach
    </ul>
@endsection