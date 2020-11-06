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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('/home');
});

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//go to profile route
Route::get('/profile/{id}/user','HomeController@view_profile')->name('profile.index');

//google route
Route::get('/sign-in/google','Auth\LoginController@google');
Route::get('/sign-in/google/redirect','Auth\LoginController@googleRedirect');

//edit profile route ke halamannya
Route::get('/profile/edit', 'HomeController@edit_user_profile')->name('profile.edit');
//edit profile buat ngedit datanya kedalam database
Route::post('/profile/{id}/edit/database_insert','Auth\UserController@edit_profile')->name('profile.confirm_edit');

//masuk ke index admin
Route::get('admin/index','Auth\AdminController@index')->name('admin.index');
