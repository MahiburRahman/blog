<?php


Route::get('/', ['as'=>'home_page', 'uses'=>'BlogController@ViewHomePage']);
Route::get('/login', ['as'=>'login_view', 'middleware' => 'GuestAuth', 'uses'=>'UserController@LogIn']);
Route::post('/login', ['as'=>'post_login', 'middleware' => 'GuestAuth', 'uses'=>'UserController@CheckLogIn']);
Route::get('/signup', ['as'=>'signup', 'middleware' => 'GuestAuth', 'uses'=>'UserController@SignUp']);
Route::post('/signup', ['as'=>'save_signup', 'middleware' => 'GuestAuth', 'uses'=>'UserController@SaveSignUp']);
Route::get('/logout', ['as'=>'logout', 'uses'=>'UserController@LogOut']);


Route::get('/profile', ['as'=>'profile_page', 'middleware' => 'LoggedInAuth', 'uses'=>'UserController@ViewProfile']);
Route::get('/your_posts', ['as'=>'my_posts', 'middleware' => 'LoggedInAuth', 'uses'=>'BlogController@ViewMyPosts']);
Route::post('/save_profile', ['as'=>'save_profile', 'middleware' => 'LoggedInAuth', 'uses'=>'UserController@SaveProfile']);

Route::get('/new_post', ['as'=>'new_post', 'middleware' => 'LoggedInAuth', 'uses'=>'PostController@AddNewPost']);
Route::post('/save_new_post', ['as'=>'save_new_post', 'middleware' => 'LoggedInAuth', 'uses'=>'PostController@SaveNewPost']);

Route::get('/post/{title}', ['as'=>'single_post', 'uses'=>'PostController@ViewSinglePost']);
Route::get('/category/{id}', ['as'=>'category_search', 'uses'=>'BlogController@SearchByCategory']);
Route::post('/save_comment/{id}', ['as'=>'save_comment', 'uses'=>'PostController@SaveComment']);
