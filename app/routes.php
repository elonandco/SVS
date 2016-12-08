<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::bind('confide.user_validator', 'MyUserValidator');
App::bind('confide.repository', 'LoginRepository');
setlocale(LC_MONETARY, 'en_US');

Route::get('/', 'HomeController@getIndex');

//Modals
Route::get('/modal/login', function(){ return View::make('modals.auth.login'); });
Route::get('/modal/signup', 'UsersController@signup');
Route::get('/modal/forgot', function(){ return View::make('modals.auth.forgot'); });
Route::get('/modal/signup/confirm', function(){ return View::make('modals.auth.confirm'); });
Route::get('/modal/bids/add_vendor/{vendor_id}', 'BidsController@add_vendor_modal');
Route::get('/modal/bids/{bid_id}/response', 'BidsController@bid_response_modal');

/* Vendor Search*/
Route::get('/search', 'SearchController@results');
Route::get('/search/results', 'SearchController@search');
Route::get('/search/categories', 'SearchController@categories');

/* User Profiles */
Route::get('profile/{slug}', array('as' => 'vendor_profile', 'uses' => 'VendorsController@profile'));
Route::get('profile/{slug}/viewers', array('as' => 'vendor_profile_viewers', 'uses' => 'VendorsController@viewers'));

/* Vendor APIs */
Route::get('vendor/{slug}', 'VendorsController@get_vendor');
Route::post('vendor/{slug}', 'VendorsController@update');
Route::get('vendor/{slug}/summary/viewers', 'VendorsController@viewers_summary');
Route::get('vendor/{slug}/projects', 'VendorsController@get_projects');
Route::post('vendor/{slug}/projects', 'VendorsController@add_project');
Route::resource('vendor.services', 'VendorServicesController');
Route::resource('vendor.certifications', 'VendorCertificationsController');


/* Bids */
Route::get('bids', array(
	'before' => array('auth'),
	'as' => 'bids',
	'uses' => 'BidsController@index'
));

Route::get('bids/new', array(
	'before' => 'auth',
	'as' => 'new_bid',
	'uses' => 'BidsController@create'
));

Route::get('bids/vendors', array('uses' => 'BidsController@get_vendors'));
Route::post('bids/vendors', array('uses' => 'BidsController@add_vendors'));
Route::delete('bids/vendors', array('uses' => 'BidsController@remove_vendors'));

Route::get('bids/{id}', array( 'as' => 'view_bid', 'uses' => 'BidsController@view') );
Route::get('bids/{id}/response', array( 'uses' => 'BidsController@response') );
Route::post('bids/{id}/response', array('before' => array('auth'), 'uses' => 'BidsController@doResponse'));

Route::post('bids/{id}/upload', array('before' => array('auth'), 'uses' => 'BidsController@doUpload'));
Route::post('bids/{id}/remove/{attachment_id}', array('before' => array('auth'), 'uses' => 'BidsController@removeUpload'));

Route::post('bids/update', array('before' => array('auth','csrf'), 'uses' => 'BidsController@update'));


/* Confide User Mangement Routes*/
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('login', 'UsersController@login');
Route::post('login', 'UsersController@doLogin');
Route::get('logout', 'UsersController@logout');
Route::post('users/{id}', 'UsersController@update');
