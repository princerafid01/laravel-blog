@extends('admin.admin_master')
@section('admin_main_content')
<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>
  	<h3 style="font-family: cursive" class="bg-success text-success text-center">
		@if(Session::has('message'))
		{{ session('message') }}
		@endif
  		
  	</h3>

<table class="table"> 
	<caption></caption>
	<thead> 
		<tr> 
			<th>#</th> 
			<th>Blog Name</th> 
			<th>Publication status</th> 
			<th>Action</th> 
			<th>Label</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($all_blog as $blog)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $blog->blog_title }}</td>  
			<td {{($blog->publication_status == 1) ? "":"style=color:red"}}>{{ ($blog->publication_status == 1) ? "Published" : "Unpublished" }} </td> 
			<td> 
				@if($blog->publication_status == 1)
				<a href="{{ URL::to('/unpublish-blog/'.$blog->blog_id) }}" class="btn btn-primary">Unpublish</a>
				@else 
				<a href="{{ URL::to('/publish-blog/'.$blog->blog_id) }}" class="btn btn-primary">Publish</a> 
				@endif
			</td>
			<td> 
				<a href="{{ URL::to('/edit-blog/'.$blog->blog_id) }}" class="btn btn-primary">Edit</a> 
				<a href="{{ URL::to('/delete-blog/'.$blog->blog_id) }}" class="btn btn-primary" onclick="return confirm('Are you sure')">Delete</a> 
			</td> 

		</tr> 
			@endforeach
	</tbody> 
</table>
@endsection