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

<table class="table"> 
	<caption></caption>
	<thead> 
		<tr> 
			<th>#</th> 
			<th>Category Name</th> 
			<th>Publication status</th> 
			<th>Action</th> 
			<th>Label</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($all_category as $category)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $category->category_name }}</td>  
			<td {{($category->publication_status == 1) ? "":"style=color:red"}}>{{ ($category->publication_status == 1) ? "Published" : "Unpublished" }} </td> 
			<td> 
				@if($category->publication_status == 1)
				<a href="{{ URL::to('/unpublish-category/'.$category->category_id) }}" class="btn btn-primary">Unpublish</a>
				@else 
				<a href="{{ URL::to('/publish-category/'.$category->category_id) }}" class="btn btn-primary">Publish</a> 
				@endif
			</td>
			<td> 
				<a href="{{ URL::to('/edit-category/'.$category->category_id) }}" class="btn btn-primary">Edit</a> 
				<a href="{{ URL::to('/delete-category/'.$category->category_id) }}" class="btn btn-primary" onclick="return confirm('Are you sure')">Delete</a> 
			</td> 

		</tr> 
			@endforeach
	</tbody> 
</table>
@endsection