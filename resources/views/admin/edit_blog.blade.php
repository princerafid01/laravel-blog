@extends('admin.admin_master')
@section('title','edit blog')
@section('admin_main_content')
<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>

  	<h3 style="font-family: cursive" class="bg-success text-success text-center">
  		<?php 
			// $message = Session::get('message');
			// if($message){
			// 	echo $message;
			// 	Session::put('message', '');
			// }
  		?>
		@if(Session::has('message'))
		{{ session('message') }}
		@endif
  		
  	</h3>
{{ Form::open(['class' => "form-horizontal" , 'url' => '/edited-blog','method' => 'post' , 'enctype' => 'multipart/data-form', 'files' => true]) }}
{{-- <form class="form-horizontal"> --}}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Blog Title</label>
    <div class="col-sm-10">
      <input type="text" name="blog_title" class="form-control" id="inputEmail3" value="{{ $blog->blog_title }}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Blog Category</label>
    <div class="col-sm-10">
      <select class="form-control" name="category_id" id="">
        <option value="">Select Blog Category</option>

        @foreach($all_cat as $cat)
          <option value="{{$cat->category_id}}" 
            {{ ($cat->category_id == $blog->category_id) ? 'selected' : '' }}
            >{{$cat->category_name}}</option>
            
        @endforeach

      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Short Description</label>
    <div class="col-sm-10">
    	<textarea name="short_description" class="form-control" id="" cols="30" rows="10">{{ $blog->short_description }} </textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Long Description</label>
    <div class="col-sm-10">
      <textarea name="long_description" class="form-control" id="" cols="30" rows="10"> {{ $blog->long_description }} </textarea>
    </div>
  </div>


  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Blog image</label>
    <div class="col-sm-10">
      <img src="{{ asset($blog->blog_image) }}" alt="{{ $blog->blog_image }}">
      <input type="file" name="blog_image">
    </div>
  </div>

  <div class="form-group">
  	<label for="inputPassword3" class="col-sm-2 control-label">Publiction status</label>
    <div class="col-sm-10">
    	<select class="form-control" name="publication_status" id="">
        <option value="0" {{($blog->publication_status == 0) ? 'selected' : ''}}>Unpublished</option>
        <option value="1" {{($blog->publication_status == 1) ? 'selected' : ''}}>Published</option>
    	</select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Add blog post</button>
    </div>
  </div>
  {{ Form::close() }}
{{-- </form> --}}
@endsection