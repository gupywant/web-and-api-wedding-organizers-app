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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('login',['as'=>'login', 'uses'=>'adminLoginController@index']);
Route::post('loginCheck',['as'=>'loginCheck', 'uses'=>'adminLoginController@login']);
 
Route::get('activation',['as'=>'user.activation', 'uses'=>'userController@activation']);
Route::get('reset',['as'=>'user.reset', 'uses'=>'userController@reset']);
Route::post('resetPost',['as'=>'user.resetPost', 'uses'=>'userController@resetPost']);

Route::middleware('sessionHasAdmin')->prefix('admin')->group(function () {
	//dashboard
	Route::get('dashboard',['as'=>'user.dashboard', 'uses'=>'adminDashboardController@index']);
	//faq
	Route::get('faqList',['as'=>'user.faqList', 'uses'=>'AdminFaqController@index']);
	Route::post('faqAdd',['as'=>'user.faqAdd', 'uses'=>'AdminFaqController@faqAdd']);
	Route::get('deleteFaq/{id}',['as'=>'user.deleteFaq', 'uses'=>'AdminFaqController@deleteFaq']);
	//tips
	Route::get('tipsList',['as'=>'user.tipsList', 'uses'=>'tipsController@tips']);
	Route::post('tipsAdd',['as'=>'user.tipsAdd', 'uses'=>'tipsController@tipsAdd']);
	Route::get('deleteTips/{id}',['as'=>'user.deleteTips', 'uses'=>'tipsController@deleteTips']);
	//user
	Route::get('addUserIndex',['as'=>'user.addUserIndex', 'uses'=>'adminController@addUserIndex']);
	Route::post('addUserNew',['as'=>'user.addUserNew', 'uses'=>'adminController@addUser']);
	Route::get('userDetail/{id}',['as'=>'user.userDetail', 'uses'=>'adminController@userDetail']);
	Route::get('ownDetail',['as'=>'user.ownDetail', 'uses'=>'adminController@ownDetail']);
	Route::post('adminUpdate/{id}',['as'=>'user.adminUpdate', 'uses'=>'adminController@adminUpdate']);
	Route::post('ownUpdate',['as'=>'user.ownUpdate', 'uses'=>'adminController@ownUpdate']);
	Route::get('resetPasswordAdmin/{id}',['as'=>'user.resetPasswordAdmin', 'uses'=>'adminController@resetPasswordAdmin']);
	Route::get('deleteAdmin/{id}',['as'=>'user.deleteAdmin', 'uses'=>'adminController@deleteAdmin']);
	Route::get('resetPasswordUser/{id}',['as'=>'user.resetPasswordUser', 'uses'=>'adminController@resetPasswordUser']);
	Route::get('deleteUser/{id}',['as'=>'user.deleteUser', 'uses'=>'adminController@deleteUser']);
	Route::post('userUpdate/{id}',['as'=>'user.userUpdate', 'uses'=>'adminController@userUpdate']);
	Route::get('adminDetail/{id}',['as'=>'user.adminDetail', 'uses'=>'adminController@adminDetail']);
	Route::get('userListIndex',['as'=>'user.userListIndex', 'uses'=>'adminController@userListIndex']);
	Route::get('adminListIndex',['as'=>'user.adminListIndex', 'uses'=>'adminController@adminListIndex']);
	Route::post('changePassword',['as'=>'user.changePassword', 'uses'=>'adminController@changePassword']);
	//service
	Route::get('allServiceListIndex',['as'=>'user.allServiceListIndex', 'uses'=>'itemController@allServiceListIndex']);
	Route::get('ownServiceListIndex',['as'=>'user.ownServiceListIndex', 'uses'=>'itemController@ownServiceListIndex']);
	Route::get('serviceTypeIndex',['as'=>'user.serviceTypeIndex', 'uses'=>'itemController@serviceTypeIndex']);
	Route::post('serviceTypeAdd',['as'=>'user.serviceTypeAdd', 'uses'=>'itemController@serviceTypeAdd']);
	Route::get('serviceAddIndex',['as'=>'user.serviceAddIndex', 'uses'=>'itemController@serviceAddIndex']);
	Route::post('serviceAddNew',['as'=>'user.serviceAddNew', 'uses'=>'itemController@serviceAddNew']);

	Route::get('serviceDetail/{id}',['as'=>'user.serviceDetail', 'uses'=>'itemController@serviceDetail']);
	Route::post('serviceUpdate/{id}',['as'=>'user.serviceUpdate', 'uses'=>'itemController@serviceUpdate']);
	Route::get('imageDelete/{id}',['as'=>'user.imageDelete', 'uses'=>'itemController@imageDelete']);
	Route::get('serviceDelete/{id}',['as'=>'user.serviceDelete', 'uses'=>'itemController@serviceDelete']);
	//booking
	Route::get('ownBookingListIndex',['as'=>'user.ownBookingListIndex', 'uses'=>'adminBookingController@ownBookingList']);
	Route::get('bookingListIndex',['as'=>'user.bookingListIndex', 'uses'=>'adminBookingController@bookingList']);
	Route::get('bookingAddIndex',['as'=>'user.bookingAddIndex', 'uses'=>'adminBookingController@bookingAddIndex']);
	Route::post('bookingAddNew',['as'=>'user.bookingAddNew', 'uses'=>'adminBookingController@bookingAddNew']);
	Route::post('statusUpdate/{id}',['as'=>'user.statusUpdate', 'uses'=>'adminBookingController@statusUpdate']);
	Route::get('bookingDelete/{id}',['as'=>'user.bookingDelete', 'uses'=>'adminBookingController@bookingDelete']);
	Route::get('bookingDate',['as'=>'user.date', 'uses'=>'adminBookingController@bookingDate']);
	//logout
	Route::get('logout',['as'=>'user.logout', 'uses'=>'adminLoginController@logout']);
});

