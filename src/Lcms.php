<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 | Aliase class visible in blade file
 */

namespace Webdoot\Lcms;

use Illuminate\Support\Facades\Auth;
use Webdoot\Lcms\Models\Setting;
use Illuminate\Support\Arr;

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

    public static function role($role)
    {
        // $user_id ? User::find($user_id)->user_type : Auth::user()->user_type ;

        $role = 'admin';
        return true;
    }

    // Check logedin user is admin
    public static function isAdmin()
    {
        $id = Auth::id();

        // Lcms users
        $users = config('lcms.users');
        $userid_role = array_column($users, 'role', 'user_id');

        // Find role listed for current user 
        $role = array_key_exists($id, $userid_role) ? $userid_role[$id] : '' ;

        return ($role=='admin') ? true : false ;
    }

    // Check logedin user is owner 
    public static function isOwner($model)
    {
        return $model->owner_id == Auth::id();
    }

    // Return user information by id
    public static function user(int $id)
    {        
        $users = config('lcms.users');
        if (count($users)) {
           foreach ($users as $user) {
               if ($user['user_id'] == $id) {
                   return $user;
               }
           }    
        }

        return [];
    }

    // Return file type
    public static function mediaType($ext)
    {
        $media_types = config('lcms.media_types');
        if (count($media_types)) {
           foreach ($media_types as $key => $type) {
               if (in_array($ext, $type)) {
                   return $key;
               }
           }    
        }
        return '';        
    }

}