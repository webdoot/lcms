<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms;

use Illuminate\Support\ServiceProvider;

class LcmsServiceProvider extends ServiceProvider
{
	
	public function boot()
	{		
		$this->loadRoutesFrom(__DIR__.'/../routes/web.php');
		$this->loadMigrationsFrom(__DIR__.'/../database/migrations');

		// $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lcms');
		// Load: package::file.line, __('lcms::messages.welcome')

		$this->loadViewsFrom(__DIR__.'/../resources/views', 'lcms');
		// Load: return view('lcms::dashboard');

		// Publish: php artisan vendor:publish --tag=lcms_public --force
		$this->publishes([__DIR__.'/../public' => public_path('vendor/lcms')], 'lcms_public');
		$this->publishes([__DIR__.'/../config/lcms.php' => config_path('lcms.php')], 'lcms_config');
		// $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang/vendor/lcms')], 'lcms_lang');
	}


	public function register()
	{
		// Call: config('lcms.app_ver');
		$this->mergeConfigFrom( __DIR__.'/../config/lcms.php', 'lcms' );
	}
	

}