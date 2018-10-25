 @extend('master')
 @section('main_content')

<div id="templatemo_content">
<h1>{{ ($category_blog[0])->category_name }}</h1>


@foreach($category_blog as $blog)
    
<div class="post_section">
        
    
  
  
  	<div class="post_date">
    	24<span>Oct</span>
	</div>
    
    <div class="post_content">
    	<h2><a href="{{ URL::to('/blog-detail/'.$blog->blog_id) }}">{{ $blog->blog_title }}</a></h2>
    	<strong>Author:</strong> {{ $blog->admin_name }} | <strong>Category:</strong> <a href="{{ URL::to('/category-blog/'.$blog->category_id) }}">{{ $blog->category_name }}</a>
    @if($blog->blog_image)
    	<a href="{{ asset($blog->blog_image) }}" target="_parent"><img src="{{ asset($blog->blog_image) }}" alt="image" /></a>
    @endif
    
    	<p>{{ $blog->short_description }}</p>
   	  <a href="{{ URL::to('/blog-detail/'.$blog->blog_id) }}">58 Comments</a> | <a href="{{ URL::to('/blog-detail/'.$blog->blog_id) }}">Continue reading...</a>

	</div>
    <div class="cleaner"></div>
</div>
@endforeach

  </div>
       	  @endsection