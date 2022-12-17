<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Webdoot\Lcms\Lcms;

class SettingUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'site_title'        => 'required|string',
            'site_sub_title'    => 'nullable|string',
            'site_logo'         => 'required|string',
            'site_logo2'        => 'nullable|string',
            'site_favicon'      => 'required|string',
            'action'            => 'required|in:site',
        ];
    }

    public function attributes()
    {
        return  [
            // 'org_name'                => 'Name',
            // 'org_address'             => 'Address',            
        ];
    }

}
