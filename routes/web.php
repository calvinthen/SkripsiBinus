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

//masuk ke admin ngeliat seluruh user (user view)
Route::get('admin/index/view_user','Auth\AdminController@view_user')->name('admin.view_user');

//hapus User
Route::get('admin/index/view_user/{id}/delete_user','Auth\UserController@delete_user')->name('admin.delete_user_now');

//user nyari team arahin ke team index
Route::get('user/find_team','TeamController@index')->name('user.find_team');

//masuk ke index create team
Route::get('user/team/create_team','TeamController@create_team_index')->name('team.create_team_index');

//submit create team
Route::POST('user/team/submit_team','TeamController@create')->name('team.create_team');

//user check profile team dia sendiri
Route::get('user/team/user_team_index','TeamController@user_team_index')->name('team.user_team_index');

//halaman list user buat diinvite ke team
Route::get('user/team/find_member','TeamController@find_member_index')->name('team.find_member');

//bikin pesan buat invite team ke user yang dituju
Route::get('user/team/{id}/invite_player','InboxController@create_invitation_team')->name('inbox.create_invitation_team');

//isi inbox user
Route::get('user/inbox','InboxController@index')->name('user.inbox');

//user nerima tawaran team button , terus langsung dia masuk ke Teamnya
Route::get('user/inbox/accept_team_invitation/{id}/{mailId}','TeamController@user_accept_team_invitation')->name('user.confirm_team_invitation');


//user ke halaman team yang dia pilih
Route::get('user/team/{id}/detail','TeamController@detail_index')->name('user.view_selected_team');


//user kirim inbox ke leader team buat request mau masuk teamnya
Route::get('user/team/{id}/request_join','InboxController@request_join_team')->name('user.request_join_team');

//list kumpulan semua user
Route::get('home/user/list','HomeController@list_user')->name('user.list_user');

//halaman detail user yang dipilih
Route::get('home/user/list/{id}/detail','HomeController@user_detail_page')->name('user.detail');

//user kirim inbox friend request ke id yang di tuju
Route::get('home/user/list/{id}/request_friend','InboxController@request_friend')->name('user.send_friend_request');

//accept user as friend
Route::get('user/inbox/accept/friend/{id}/{idMail}','FriendController@create')->name('user.accept_friend_request');


//isi friendlist user
Route::get('user/profile/friendlist/','FriendController@index')->name('user.friendlist');
