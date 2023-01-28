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
use Webdoot\Lcms\Models\Article;
use Webdoot\Lcms\Models\Media;
// use Illuminate\Support\Arr;

class Lcms
{
    public static function get($code, $sub_code=null, $arr_key=null)
    {
    	// Get Article
    	if(substr($code, 0, 2) === 'a_')
    	{
            $id = substr($code, 2);
            $article = Article::find($id);
            if ($article) {
                $article = $sub_code ? $article->$sub_code : $article ;
            }
            if ($article) {
                $article = ($sub_code && $arr_key!==null) ? $article[$arr_key] : $article ;
            }           
    		return $article ;
    	}

        // Get Menu
        if(substr($code, 0, 2) === 's_')
        {
            $id = substr($code, 2);
            $article = Article::find($id);
            if ($article) {
                return $article->content_json;          
            }            
            return [];
        }

        // Get Slider
        if(substr($code, 0, 2) === 'm_')
        {
            $id = substr($code, 2);
            $article = Article::find($id);
            if ($article) {
                $menu = $article->content_json;

                if ($menu) {
                    $menu = $sub_code!==null ? $menu[$sub_code] : $menu ;
                }
                if ($menu) {
                    $menu = ($sub_code!==null && $arr_key!==null) ? $menu->$arr_key : $menu ;
                }           
                return $menu ;
            }            
            return [];
        }

        // Get Gallery
        if(substr($code, 0, 2) === 'g_')
        {
            $id = substr($code, 2);
            $article = Article::find($id);
            if ($article) {
                $items = $article->content_json;           
                return $items ;
            }            
            return [];
        }

        // Get Media
        if(substr($code, 0, 3) === 'md_')
        {
            $id = substr($code, 3);
            $media = Media::find($id);
            if ($media) {
                $media = $sub_code ? $media->$sub_code : $media ;
            }            
            return $media ;
        }

    	// Get Setting
    	elseif(substr($code, 0, 5) == 'site_')
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

    // Is user in this app
    public static function isUser()
    {
        // Draft code
        return true;
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