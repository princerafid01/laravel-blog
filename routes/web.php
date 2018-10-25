<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , 'FirstController@index');
Route::get('/portfolio' , 'FirstController@portfolio');
Route::get('/services' , 'FirstController@services');
Route::get('/contact-us' , 'FirstController@contactUs');
Route::get('/blog-detail/{id}' , 'FirstController@blogDetail');
Route::get('/category-blog/{id}' , 'FirstController@categoryBlog');
Route::post('/save-comments' , 'FirstController@saveComments');
Route::post('/save-comments-reply' , 'FirstController@saveCommentsReply');





/* Admin panel */

Route::get('/admin-panel','AdminController@index');
Route::post('/admin-login-check','AdminController@adminLoginCheck');
Route::get('/dashboard','SuperAdminController@index');
Route::get('/add-category','SuperAdminController@add_category');
Route::get('/manage-category','SuperAdminController@manage_category');
Route::get('/manage-blog','SuperAdminController@manageBlog');
Route::get('/manage-comments','SuperAdminController@manageComments');
Route::get('/unpublish-category/{id}','SuperAdminController@unpublishCategory');
Route::get('/publish-category/{id}','SuperAdminController@publishCategory');


Route::get('/unpublish-blog/{id}','SuperAdminController@unpublishBlog');
Route::get('/publish-blog/{id}','SuperAdminController@publishBlog');


Route::get('/unpublish-comment/{id}','SuperAdminController@unpublishComment');
Route::get('/publish-comment/{id}','SuperAdminController@publishComment');


Route::get('/delete-category/{id}','SuperAdminController@deleteCategory');
Route::get('/delete-blog/{id}','SuperAdminController@deleteBlog');
Route::get('/admin-logout','SuperAdminController@logout');
Route::get('/edit-category/{id}','SuperAdminController@editCategory');
Route::get('/edit-blog/{id}','SuperAdminController@editBlog');
Route::get('/add-blog','SuperAdminController@addBlog');
Route::post('/edited-category/{id}','SuperAdminController@editedCategory');
Route::post('/edited-blog/{id}','SuperAdminController@editedCategory');
Route::post('/save-category','SuperAdminController@save_category');
Route::post('/save-blog','SuperAdminController@saveBlog');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
