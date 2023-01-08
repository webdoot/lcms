<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Webdoot\Lcms\Http\Controllers', 'prefix' => 'lcms'], function(){

	// Dashboard 
	Route::get('/', 'DashboardController@dashboardRedirect');
	Route::get('/dashboard', 'DashboardController@dashboard')->name('lcms_dashboard');

	// Media 
	Route::resource('/lcms_media', 'MediaController')->except([]);

	// Artcle 
	Route::resource('/lcms_article', 'ArticleController');

	// Menu 
	Route::resource('/lcms_menu', 'MenuController');

	// Post 
	Route::resource('/lcms_post', 'PostController')->except([]);

	// Slider 
	Route::resource('/lcms_slider', 'SliderController');

	// Gallery 
	Route::resource('/lcms_gallery', 'GalleryController');


	// Setting  
	Route::get('/lcms_setting', 'SettingController@index')->name('lcms_setting.index'); 
	Route::put('/lcms_setting', 'SettingController@update')->name('lcms_setting.update');
	// Icons  
	Route::get('/lcms_icon', 'SettingController@icon')->name('lcms_icon.index'); 

});

