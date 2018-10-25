@extends('admin.admin_master')
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
{{ Form::open(['class' => "form-horizontal" , 'url' => '/edited-category/'.$category->category_id]) }}
{{-- <form class="form-horizontal"> --}}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
    <div class="col-sm-10">
      <input type="text" name="category_name" class="form-control" id="inputEmail3" value="{{$category->category_name}}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Category Description</label>
    <div class="col-sm-10">
    	<textarea name="category_description" class="form-control" id="" cols="30" rows="10">{{$category->category_description}} </textarea>
      {{-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> --}}
    </div>
  </div>

  <div class="form-group">
  	<label for="inputPassword3" class="col-sm-2 control-label">Publiction status</label>
    <div class="col-sm-10">
    	<select class="form-control" name="publication_status" id="">
    		<option value="">Select Publiction Status</option>
    		<option value="0" {{($category->publication_status == 0) ? 'selected' : ''}}>Unpublished</option>
    		<option value="1" {{($category->publication_status == 1) ? 'selected' : ''}}>Published</option>
    	</select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Edit category</button>
    </div>
  </div>
  {{ Form::close() }}
{{-- </form> --}}
@endsection