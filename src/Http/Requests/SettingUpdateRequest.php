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
        $site = [
            'site_title'        => 'required|string',
            'site_sub_title'    => 'nullable|string',
            'site_logo'         => 'required|string',
            'site_logo2'        => 'nullable|string',
            'site_favicon'      => 'required|string',
            'action'            => 'required|in:site',
        ];

        $address = [
            "contact"           => "sometimes|nullable|array",
            "contact.*.title"   => "sometimes|nullable|string",
            "contact.*.phone"   => "sometimes|nullable|string",
            "contact.*.email"   => "sometimes|nullable|string",
            "contact.*.address" => "sometimes|nullable|string",
            'action'            => 'required|in:address',
        ];


        switch ($this->action) {
            case 'site' :  return $site ;  break;
            case 'address':  return $address ; break;
        };
    }

}
