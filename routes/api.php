<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login',['as'=>'user.login', 'uses'=>'userController@login']);
Route::post('register',['as'=>'user.login', 'uses'=>'userController@register']);
Route::post('userForgot',['as'=>'api.userForgot', 'uses'=>'userController@forgot']);
Route::middleware('userHasLogin')->prefix('private')->group(function () {
	//user dashborad
	Route::post('dashboard',['as'=>'api.dashborad', 'uses'=>'userDashboardController@dashboard']);
	//User Data
	Route::post('userUpdate',['as'=>'api.userUpdate', 'uses'=>'userController@update']);
	Route::post('userPassword',['as'=>'api.userPassword', 'uses'=>'userController@password']);
	Route::post('userProfile',['as'=>'api.userProfile', 'uses'=>'userController@profile']);
	Route::post('userForgot',['as'=>'api.userForgot', 'uses'=>'userController@forgot']);
	//Faq
	Route::post('faq',['as'=>'api.faq', 'uses'=>'UserFaqController@faq']);
	//tips
	Route::post('tips',['as'=>'api.tips', 'uses'=>'tipsController@list']);
	//booking
	Route::post('bookingAdd',['as'=>'api.bookingAdd', 'uses'=>'bookingController@add']);
	Route::post('bookingRequesting',['as'=>'api.bookingRequesting', 'uses'=>'bookingController@requesting']);
	Route::post('bookingReserved',['as'=>'api.bookingReserved', 'uses'=>'bookingController@reserved']);
	Route::post('bookingDelete',['as'=>'api.bookingDelete', 'uses'=>'bookingController@Delete']);
	//bookmark
	Route::post('bookmarkAdd',['as'=>'api.bookmarkAdd', 'uses'=>'bookmarkController@add']);
	Route::post('bookmarkList',['as'=>'api.bookmarkList', 'uses'=>'bookmarkController@list']);
	Route::post('bookmarkDelete',['as'=>'api.bookmarkDelete', 'uses'=>'bookmarkController@Delete']);
	//search
	Route::post('lokasi',['as'=>'api.lokasi', 'uses'=>'userSearchController@lokasi']);
	Route::post('kategori',['as'=>'api.kategori', 'uses'=>'userSearchController@kategori']);
	Route::post('result',['as'=>'api.result', 'uses'=>'userSearchController@result']);
	Route::post('detail',['as'=>'api.detail', 'uses'=>'userSearchController@detail']);
	Route::post('addView',['as'=>'api.addView', 'uses'=>'itemController@addView']);
});
