<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Webdoot\Lcms\Http\Controllers', 'prefix' => 'lcms'], function(){

	//----------------- Dashboard -------------------
	Route::get('/', 'DashboardController@dashboardRedirect');
	Route::get('/dashboard', 'DashboardController@dashboard')->name('lcms_dashboard');

 

});

