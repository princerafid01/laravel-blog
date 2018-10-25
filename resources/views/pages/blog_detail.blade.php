@extend('master')
@section('main_content')

<div id="templatemo_content">
<div class="post_section">

	<div class="post_date">
    	30<span>Nov</span>
	</div>
    <div class="post_content">
    
        <h2>{{ $blog_info->blog_title }}</h2>
        
    	<strong>Author:</strong> {{ $blog_info->admin_name }} | <strong>Category:</strong> <a href="{{ URL::to('/category-blog/'.$blog_info->category_id) }}">{{ $blog_info->category_name }}</a>
        
        <a href="#"><img src="{{ asset($blog_info->blog_image) }}" alt="Templates" /></a>
        
        <p>{{ $blog_info->long_description }}</p>


<div class="comment_tab">
            {{ count($all_comments) }} Comments
        </div>

@foreach($all_comments as $comment)
<div id="comment_section">
    <ol class="comments first_level">
            
            <li>
                <div class="comment_box commentbox1">
                        
                    <div class="gravatar">
                        <img src="{{ asset('images/avator.png') }}" alt="author 6" />
                    </div>
                    
                    <div class="comment_text">
                        <div class="comment_author">{{ $comment->name }} <span class="date time">{{ date('M j , Y g:i A',strtotime($comment->created_at)) }}</span></div>
                        <p>{{ $comment->comments }}</p>
    @if(Auth::user() != Null)

                      <div class="reply"><a href="#" class="reply" id="{{ $comment->comment_id }}">Reply</a></div>
    @endif
                    </div>
                    <div class="cleaner"></div>
                </div>                        
                
            </li>

            

            <li class="reply-comment">
                	<ol class="comments">
                            
                {{-- Reply Comment Starts --}}
                @foreach($reply_info as $reply)
                @if($reply->parent_id == $comment->comment_id)
                        <li>
                            <div class="comment_box commentbox2">
                            
                            <div class="gravatar">
                            <img src="{{ asset('images/avator.png') }}" alt="author 5" />
                            </div>
                            <div class="comment_text">
                            <div class="comment_author">{{ $reply->name }} <span class="date time">{{ date('M j , Y g:i A',strtotime($reply->created_at)) }}</span> </div>
                            <p>{{ $reply->comments }}</p>
                            
                            
                            <div class="cleaner"></div>
                            </div>                        
                        
                        
                        </li>
{{-- Reply Comments Ends --}}

@endif
                        @endforeach


                                                {{-- Reply Form  Starts--}}

    @if(Auth::user() != Null)


<li class="reply-form {{ $comment->comment_id }}" id="{{ $comment->comment_id }}">                        
    <div id="comment_form">
        <h3>Leave a reply</h3>
        
        {!! Form::open(['url' => '/save-comments-reply', 'method' => 'post']) !!}
            
            
            <div class="form_row">
                <label>Your reply</label><br />
                <textarea  name="comments" rows="5" cols="15"></textarea>
                <input type="hidden" name="blog_id" value="{{ $blog_info->blog_id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->comment_id }}" />
                <input type="hidden" id="reply_id" value="{{ $reply->comment_id }}" />
            </div>

            {{-- <input type="submit" name="Submit" value="Submit" class="submit_btn" /> --}}
            {!! Form::submit('Submit' , ['name' => 'submit' , 'class' => 'submit_btn']) !!}
        {!! Form::close() !!}        
        
    </div>
</li>
@endif


{{-- Reply Ends  --}}
                        
                    </ol>  
			</li> 




        </ol>
    </div>
@endforeach

    @if(Auth::user() != Null)


      	<h3 style="font-family: cursive" class="bg-success text-success text-center">
 
    		@if(Session::has('message'))
    			{{ session('message') }}
    		@endif
      		
      	</h3>

        
    	<div id="comment_form">
        <h3>Leave a comment</h3>
        
        {!! Form::open(['url' => '/save-comments', 'method' => 'post']) !!}
            
            
            <div class="form_row">
                <label>Your comment</label><br />
                <textarea  name="comments" rows="" cols=""></textarea>
                <input type="hidden" name="blog_id" value="{{ $blog_info->blog_id }}" />
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

            </div>

            {{-- <input type="submit" name="Submit" value="Submit" class="submit_btn" /> --}}
            {!! Form::submit('Submit' , ['name' => 'submit' , 'class' => 'submit_btn']) !!}
		{!! Form::close() !!}        
        
    </div>
    @else
<div class="comment_tab">
    <h3>Please <a href="{{ URL::to('/login') }}">login </a> or <a href="{{ URL::to('/register') }}">register</a> to comment or to give reply.</h3>
        </div>

    @endif
    
	</div>

    <div class="cleaner"></div>
    
</div>
</div>
@endsection