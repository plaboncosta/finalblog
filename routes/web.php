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

Route::get('/', 'HomeController@index')->name('home');
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('tag/{slug}', 'PostController@postByTag')->name('tag.posts');
Route::group(['middleware' => ['auth']], function(){
	Route::post('favorite/{post}/add', 'FavoriteController@add')->name('favorite.post');
	Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});
Route::put('subscriber', 'SubscriberController@store')->name('subscriber.store');
Route::get('search', 'SearchController@search')->name('search');
Route::get('profile/{username}', 'AuthorController@profile')->name('author.profile');



Auth::routes();


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('settings', 'SettingsController@index')->name('settings');
	Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
	Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
	Route::resource('tag', 'TagController');
	Route::resource('category', 'CategoryController');
	Route::resource('post', 'PostController');

	Route::get('pending/post', 'PostController@pending')->name('post.pending');
	Route::put('post/{id}/approve', 'PostController@approve')->name('post.approve');

	Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
	Route::delete('subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');

	Route::get('favorite/post', 'FavoriteController@index')->name('favorite.post');

	Route::get('comments', 'CommentController@index')->name('comment.index');
	Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
	Route::get('authors', 'AuthorController@index')->name('author.index');
	Route::delete('authors/{id}', 'AuthorController@destroy')->name('author.destroy');
	Route::get('social', 'SocialController@index')->name('social.index');
	Route::put('social', 'SocialController@update')->name('social.update');
});


Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('settings', 'SettingsController@index')->name('settings');
	Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
	Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
	Route::resource('post', 'PostController');
	Route::get('comments', 'CommentController@index')->name('comment.index');
	Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
});


View::composer('layouts.frontend.partial.footer', function($view){
	$categories = App\Category::all();
	$view->with('categories', $categories);
});