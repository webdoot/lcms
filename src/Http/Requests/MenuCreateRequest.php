<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required|string',

            "menu"              => "sometimes|required|array",
            "menu.*.name"       => "sometimes|required|string",
            "menu.*.url"        => "sometimes|nullable|string",
            "menu.*.image"      => "sometimes|nullable|string",
            "menu.*.description"=> "sometimes|nullable|string",
            "menu.*.items"      => "sometimes|nullable|array",
            "menu.*.items.*.*"  => "sometimes|nullable|string",

            'action'            => 'required|in:menu',
        ];
    }

}
