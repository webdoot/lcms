<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webdoot\Lcms\Models\Setting;
use Webdoot\Lcms\Http\Requests\SettingUpdate;

class SettingController extends Controller
{
    public function index()
    {
        return view('lcms::setting.index');
    }
    
    public function update(SettingUpdate $req)
    {
    	if ($req->action == 'site') {
    		if($req->site_title)        Setting::set('site_title', $req->site_title);
	    	if($req->site_sub_title)    Setting::set('site_sub_title', $req->site_sub_title);
	    	if($req->site_logo)         Setting::set('site_logo', $req->site_logo);
	    	if($req->site_logo_2)       Setting::set('site_logo_2', $req->site_logo_2);
	    	if($req->site_favicon)      Setting::set('site_favicon', $req->site_favicon);
	    	if($req->site_header)       Setting::set('site_header', $req->site_header);

	        return back()->with('flash_success', __('Site setting updated..'));
    	}

    	elseif($req->action == 'site')
    	{

    	}
    	
    }

}
