<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;
use App\Foule;
use Illuminate\Support\Facades\Redirect;
session_start();

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function auth_check()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id == NULL) {
            return Redirect::to('/admin-panel')->send();
        }
    }
    public function index()
    {
        $this->auth_check();
        $admin_dashboard = view('admin.admin_dashboard');
        $admin_welcome_box = view('admin.admin_welcome_box');
        $admin_sidebar = view('admin.admin_sidebar');
        return view('admin.admin_master')
                ->with('admin_main_content', $admin_dashboard)
                ->with('admin_welcome', $admin_welcome_box)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }

    public function add_category()
    {
        $this->auth_check();
        $add_category = view('admin.add_category');
        $admin_sidebar = view('admin.admin_sidebar');

        return view('admin.admin_master')
                ->with('admin_main_content', $add_category)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }


    public function addBlog()
    {
        $this->auth_check();

        $all_published_category = DB::table('tbl_category')
                                    ->where('publication_status',1)
                                    ->get();

        $add_blog = view('admin.add_blog')
                    ->with('all_published_category',$all_published_category);
        return view('admin.admin_master')
                ->with('admin_main_content', $add_blog);
    }

    public function saveBlog(Request $request)
    {

        $data = [];
        $data['blog_title'] = $request->blog_title;
        $data['admin_id'] = Session::get('admin_id');
        $data['category_id'] = $request->category_id;
        //$data['blog_image'] = $request->blog_image;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('blog_image'); 

        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $upload_path = "blog_image/";
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if ($success) {
                $data['blog_image'] = $image_url;
                DB::table('tbl_blog')->insert($data); 
                $request->session()->flash('message','Blog saved!');
                return Redirect::back();                               
            }

        } else {

            DB::table('tbl_blog')->insert($data);

            $request->session()->flash('message','Blog saved!');
            return Redirect::back();
        }
    }


    public function editCategory($category_id)
    {
        $this->auth_check();
        $data = DB::table('tbl_category')
                ->where('category_id' , $category_id)
                ->first();
        $edit_category = view('admin.edit_category')
                            ->with('category',$data);
        $admin_sidebar = view('admin.admin_sidebar');

        return view('admin.admin_master')
                ->with('admin_main_content', $edit_category)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }


    public function editBlog($blog_id)
    {
        $this->auth_check();
        $cat = DB::table('tbl_category')
                ->where('publication_status',1)
                ->get();
        $data = DB::table('tbl_blog')
                ->where('blog_id' , $blog_id)
                ->first();
        $edit_blog = view('admin.edit_blog')
                            ->with('blog',$data)
                            ->with('all_cat',$cat);
        $admin_sidebar = view('admin.admin_sidebar');

        return view('admin.admin_master')
                ->with('admin_main_content', $edit_blog)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }



    public function editedCategory(Request $request , $category_id)
    {

        $data = [];
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;
        DB::table('tbl_category')
                    ->where('category_id',$category_id)
                    ->update($data);
        // Session::put('message','Category has been added!');
        $request->session()->flash('message','Category has been edited!');
        return Redirect::to('/manage-category');
    }

    public function editedBlog(Request $request , $blog_id)
    {

        $data = [];
        $data['blog_title'] = $request->blog_title;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['publication_status'] = $request->publication_status;
        DB::table('tbl_blog')
                    ->where('blog_id',$blog_id)
                    ->update($data);
        // Session::put('message','blog has been added!');
        $request->session()->flash('message','Blog has been edited!');
        return Redirect::to('/manage-blog');
    }


    public function save_category(Request $request)
    {
        $data = [];
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;
        DB::table('tbl_category')
                    ->insert($data);
        // Session::put('message','Category has been added!');
        $request->session()->flash('message','Category has been added!');
        return Redirect::back();
        
    }

    public function manage_category()
    {
        $this->auth_check();
        $all_category = DB::table('tbl_category')
                        ->get();
        $manage_category = view('admin.manage_category')
                        ->with('all_category', $all_category);
        $admin_sidebar = view('admin.admin_sidebar');


        return view('admin.admin_master')
                ->with('admin_main_content', $manage_category)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }


    public function manageComments()
    {
        $this->auth_check();
        $all_comments = DB::table('tbl_comments')
        ->join('tbl_blog','tbl_comments.blog_id' , '=' , 'tbl_blog.blog_id')
        ->join('users','tbl_comments.user_id' , '=' , 'users.id')
        ->select('tbl_comments.*','tbl_blog.blog_title','users.name')
                        ->get();
        $manage_comments = view('admin.manage_comments')
                        ->with('all_comments', $all_comments);
        $admin_sidebar = view('admin.admin_sidebar');


        return view('admin.admin_master')
                ->with('admin_main_content', $manage_comments)
                ->with('admin_sidebar', $admin_sidebar)
                ;
    }



    public function manageBlog()
    {
        $this->auth_check();
        $all_blog = DB::table('tbl_blog')
                        ->get();
        $manage_blog = view('admin.manage_blog')
                        ->with('all_blog', $all_blog);


        return view('admin.admin_master')
                ->with('admin_main_content', $manage_blog);
    }



    public function logout()
    {
        Session::put('admin_id', '');
        Session::put('admin_name','');
        Session::put('message','You are successfully logout !');
        return Redirect::to('admin-panel');
    }

    public function unpublishCategory($category_id)
    {
        $data = [];
        $data['publication_status'] = 0;

        DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->update($data);
        return Redirect::back();
    }

    public function publishCategory($category_id)
    {
        $data = [];
        $data['publication_status'] = 1;

        DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->update($data);
        return Redirect::back();
    }




    public function unpublishComment($comment_id)
    {
        $data = [];
        $data['publication_status'] = 0;

        DB::table('tbl_comments')
                ->where('comment_id', $comment_id)
                ->update($data);
        return Redirect::back();
    }

    public function publishComment($comment_id)
    {
        $data = [];
        $data['publication_status'] = 1;

        DB::table('tbl_comments')
                ->where('comment_id', $comment_id)
                ->update($data);
        return Redirect::back();
    }





    public function unpublishBlog($blog_id)
    {
        $data = [];
        $data['publication_status'] = 0;

        DB::table('tbl_blog')
                ->where('blog_id', $blog_id)
                ->update($data);
        return Redirect::back();
    }

    public function publishBlog($blog_id)
    {
        $data = [];
        $data['publication_status'] = 1;

        DB::table('tbl_blog')
                ->where('blog_id', $blog_id)
                ->update($data);
        return Redirect::back();
    }



    public function deleteCategory($category_id)
    {
        // $data = [];
        // $data['publication_status'] = 1;

        DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->delete();
        return Redirect::back();
    }

    public function deleteBlog($blog_id)
    {
        // $data = [];
        // $data['publication_status'] = 1;

        DB::table('tbl_blog')
                ->where('blog_id', $blog_id)
                ->delete();
        return Redirect::back();
    }




    // public function search(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $output = '';
    //         $blogs = DB::table('tbl_comments')
    //         ->join('tbl_blog','tbl_comments.blog_id' , '=' , 'tbl_blog.blog_id')
    //         ->select('tbl_comments.*','tbl_blog.blog_title')
    //         ->where('blog_title','Like','%',$request->search,'%')
    //         ->get();
    //         if ($blogs) {
    //             $output .= view('admin.search')->with('blogs',$blogs);
    //         }
    //     }
    //     return $output;
    // }

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
