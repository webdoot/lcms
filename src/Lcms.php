<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms;

use Webdoot\Lcms\Models\Setting;

class Lcms
{
    public static function get($code)
    {
    	// Get from Article
    	if(substr($code, 1, 1) === '_')
    	{
    		return 'Article' ;
    	}

    	// Get from Setting
    	elseif(substr($code, 1, 1) != '_')
    	{
    		return Setting::get($code) ;
    	}
    	
    }

}