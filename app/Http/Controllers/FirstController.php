<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; 
use View;



class FirstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_published_blog = DB::table('tbl_blog')
->join('tbl_admin','tbl_blog.admin_id','=','tbl_admin.admin_id')
->join('tbl_category','tbl_blog.category_id','=','tbl_category.category_id')
->select('tbl_blog.*','tbl_admin.admin_name','tbl_category.category_name')
                                ->where('tbl_blog.publication_status','1')
                                ->orderBy('blog_id','desc')
                                ->get();



        // $all_comments = DB::table()
        $home_content = view('pages.home')
                        ->with('all_blog',$all_published_blog);
        $cat = DB::table('tbl_category')
                            ->where('publication_status',1)
                            ->get();
        $r_blog = DB::table('tbl_blog')
                    ->orderBy('blog_id','desc')
                    ->limit(3)
                    ->where('publication_status',1)
                    ->get();

        $category = view('pages.category')->with('cat',$cat);
        $recent_blog = view('pages.recent_blog')->with('recent_blog',$r_blog);
        $popular_blog = view('pages.popular_blog');


        return View::make('master')
            ->with('main_content', $home_content)
            ->with('recent_blog', $recent_blog)
            ->with('popular_blog', $popular_blog)
            ->with('category' , $category);
    }

    public function blogDetail($blog_id)
    {
        $blog_info = DB::table('tbl_blog')
->join('tbl_admin','tbl_blog.admin_id','=','tbl_admin.admin_id')
->join('tbl_category','tbl_blog.category_id','=','tbl_category.category_id')
->where('blog_id',$blog_id)
->select('tbl_blog.*','tbl_admin.admin_name','tbl_category.category_name')
                    ->first();



        $reply_info = DB::table('tbl_comments')
        ->join('users','tbl_comments.user_id','=','users.id')
                    ->where('publication_status' , 1)
                    ->where('parent_id', '!=' , 0 )
        ->select('tbl_comments.*','users.name')
                    ->get();




        $all_comments = DB::table('tbl_comments')
        ->join('users' , 'tbl_comments.user_id' , '=' , 'users.id')
        ->select('tbl_comments.*','users.name')
        ->where('tbl_comments.blog_id' , $blog_id)
        ->where('tbl_comments.publication_status' , 1)
        ->where('tbl_comments.parent_id' , 0)
                        ->get();




        $blog_detail = view('pages.blog_detail')
                        ->with('blog_info',$blog_info)
                        ->with('all_comments', $all_comments)
                        ->with('reply_info', $reply_info);




        // $udata['hit_count'] = $blog_info->hit_count + 1;
        DB::table('tbl_blog')
        ->where('blog_id',$blog_id)
        ->increment('hit_count');

        $cat = DB::table('tbl_category')
                            ->where('publication_status',1)
                            ->get();
        $r_blog = DB::table('tbl_blog')
                    ->orderBy('blog_id','desc')
                    ->limit(3)
                    ->where('publication_status',1)
                    ->get();

        $category = view('pages.category')->with('cat',$cat);
        $recent_blog = view('pages.recent_blog')->with('recent_blog',$r_blog);
        $popular_blog = view('pages.popular_blog');


        return view('master')
                ->with('main_content',$blog_detail)
                ->with('popular_blog', $popular_blog)
                ->with('recent_blog', $recent_blog)
                ->with('category' , $category);
        }


    public function categoryBlog($category_id)
    {
        $category_blog = DB::table('tbl_blog')
        ->join('tbl_admin','tbl_blog.admin_id','=','tbl_admin.admin_id')
        ->join('tbl_category','tbl_blog.category_id','=','tbl_category.category_id')
        ->select('tbl_blog.*','tbl_admin.admin_name','tbl_category.category_name')
                        ->where('tbl_blog.publication_status',1)
                        ->where('tbl_blog.category_id', $category_id)
                        ->orderBy('tbl_blog.blog_id','desc')
                        ->get();


        $cat = DB::table('tbl_category')
                            ->where('publication_status',1)
                            ->get();
        $r_blog = DB::table('tbl_blog')
                    ->orderBy('blog_id','desc')
                    ->limit(3)
                    ->where('publication_status',1)
                    ->get();

        $category = view('pages.category')->with('cat',$cat);
        $recent_blog = view('pages.recent_blog')->with('recent_blog',$r_blog);
        $popular_blog = view('pages.popular_blog');


        $category_home = view('pages.category_home')
                        ->with('category_blog' , $category_blog);

        return view('master')
                ->with('main_content',$category_home)
                ->with('popular_blog', $popular_blog)
                ->with('recent_blog', $recent_blog)
                ->with('category' , $category);



    }

    public function portfolio()
    {
        $portfolio = view('pages.portfolio');
        return view('master')
            ->with('main_content', $portfolio);

    }

    public function services()
    {
        $services = view('pages.services');
        return view('master')
            ->with('main_content' , $services);
    }

    public function contactUs()
    {
        $contact = view('pages.contact');
        return view('master')
            ->with('main_content' , $contact);
    }



    public function saveComments(Request $request)
    {
        $data = [];
        $data['blog_id'] = $request->blog_id; 
        $data['user_id'] = $request->user_id; 
        $data['comments'] = $request->comments;

        DB::table('tbl_comments')
        ->insert($data); 

        $request->session()->flash('message',"Your comment is waiting for approval by the admin.");
        return Redirect::back();
    }

    public function saveCommentsReply(Request $request)
    {
        $data = [];
        $data['blog_id'] = $request->blog_id; 
        $data['user_id'] = $request->user_id; 
        $data['comments'] = $request->comments;
        $data['parent_id'] = $request->parent_id;


        $reply_info = DB::table('tbl_comments')
                    ->where('publication_status' , 1)
                    ->where('parent_id', $request->parent_id)
                    ->get();

        DB::table('tbl_comments')
        ->insert($data); 


        $request->session()->flash('message',"Your reply is waiting for approval by the admin.");
        return Redirect::back();
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
