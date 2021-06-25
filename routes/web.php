<?php

use Illuminate\Support\Facades\Route;
// use App\Image;
// use App\User;
// use App\Comment;
// use App\Like;

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
//     // $users = User::all();

//     // foreach ( $users as $user )
//     // {
//     //     var_dump($user->nick);
//     // }

//     // $comments = Comment::all();

//     // foreach ( $comments as $comment )
//     // {
//     //     var_dump($comment->content);
//     // }

//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('user', 'UserController')->middleware('auth');
Route::resource('image', 'ImageController')->middleware('auth');
Route::resource('comment', 'commentController')->middleware('auth');
Route::resource('like', 'LikeController')->middleware('auth');