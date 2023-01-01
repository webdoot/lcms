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
use Webdoot\Lcms\Http\Requests\SettingUpdateRequest;
use Webdoot\Lcms\Lcms;

class SettingController extends Controller
{
    public function index()
    {
        return view('lcms::setting.index');
    }
    
    public function update(SettingUpdateRequest $req)
    {   
        // if not App admin
        if(!Lcms::isAdmin()) return back()->withErrors(['User is not authorised...']);

		if($req->site_title)        Setting::set('site_title', $req->site_title);
    	if($req->site_sub_title)    Setting::set('site_sub_title', $req->site_sub_title);
    	if($req->site_logo)         Setting::set('site_logo', $req->site_logo);
    	if($req->site_logo2)        Setting::set('site_logo2', $req->site_logo2);
    	if($req->site_favicon)      Setting::set('site_favicon', $req->site_favicon);

        return back()->with('flash_success', 'Site setting updated..');
    }


    // icons
    public function icon()
    {
        return view('lcms::setting.icon');
    }

}
