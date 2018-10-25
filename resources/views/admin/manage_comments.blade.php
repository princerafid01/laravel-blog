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
	<h1 class="text-center">Comments</h1>
	<thead> 
		<tr> 
			<th>#</th> 
			<th>Blog title</th> 
			<th>User Name</th> 
			<th>Comments</th> 
			<th>Publication status</th> 
			<th>Action</th>
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($all_comments as $comment)
			@if($comment->parent_id == 0)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $comment->blog_title }}</td>  
			<td>{{ $comment->name }}</td>  
			<td>{{ $comment->comments }}</td>  
			<td {{($comment->publication_status == 1) ? "":"style=color:red"}}>{{ ($comment->publication_status == 1) ? "Published" : "Unpublished" }} </td> 
			<td> 
				@if($comment->publication_status == 1)
				<a href="{{ URL::to('/unpublish-comment/'.$comment->comment_id) }}" class="btn btn-primary">Unpublish</a>
				@else 
				<a href="{{ URL::to('/publish-comment/'.$comment->comment_id) }}" class="btn btn-primary">Publish</a> 
				@endif
			</td>

		</tr> 
		@endif
			@endforeach
	</tbody> 
</table>


<table class="table"> 
	<h1 class="text-center">Replies</h1>
	<thead> 
		<tr> 
			<th>#</th> 
			<th>Blog title</th> 
			<th>User Name</th> 
			<th>Replies</th> 
			<th>Publication status</th> 
			<th>Action</th>
		</tr> 
	</thead> 
	<tbody> 
		<?php 

			$i = 1;
		?>
			@foreach($all_comments as $comment)
			@if($comment->parent_id != 0)
		<tr> 
			<th scope="row">{{ $i++ }}</th> 
			<td>{{ $comment->blog_title }}</td>  
			<td>{{ $comment->name }}</td>  
			<td>{{ $comment->comments }}</td>  
			<td {{($comment->publication_status == 1) ? "":"style=color:red"}}>{{ ($comment->publication_status == 1) ? "Published" : "Unpublished" }} </td> 
			<td> 
				@if($comment->publication_status == 1)
				<a href="{{ URL::to('/unpublish-comment/'.$comment->comment_id) }}" class="btn btn-primary">Unpublish</a>
				@else 
				<a href="{{ URL::to('/publish-comment/'.$comment->comment_id) }}" class="btn btn-primary">Publish</a> 
				@endif
			</td>

		</tr> 
		@endif
			@endforeach
	</tbody> 
</table>


@endsection