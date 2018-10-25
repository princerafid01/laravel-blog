@extends('admin.admin_master')
@section('admin_content')


  	<h3 style="font-family: cursive" class="bg-success text-success text-center">

		@if(Session::has('message'))
		{{ session('message') }}
		@endif
  		
  	</h3>
{{ Form::open(['class' => "form-horizontal" , 'url' => '/save-category']) }}
{{-- <form class="form-horizontal"> --}}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
    <div class="col-sm-10">
      <input type="text" name="category_name" class="form-control" id="inputEmail3" placeholder="Category name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Category Description</label>
    <div class="col-sm-10">
    	<textarea name="category_description" class="form-control" id="" cols="30" rows="10"> </textarea>
      {{-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> --}}
    </div>
  </div>

  <div class="form-group">
  	<label for="inputPassword3" class="col-sm-2 control-label">Publiction status</label>
    <div class="col-sm-10">
    	<select class="form-control" name="publication_status" id="">
    		<option value="">Select Publiction Status</option>
    		<option value="0">Unpublished</option>
    		<option value="1">Published</option>
    	</select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Add category</button>
    </div>
  </div>
  {{ Form::close() }}
{{-- </form> --}}
@endsection