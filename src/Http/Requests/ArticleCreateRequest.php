<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'        => 'nullable|string',    //req
            'sub_title'    => 'nullable|string',
            'label'        => 'nullable|string',
            'content'      => 'nullable|string',    //req
            'sub_content'  => 'nullable|string',

            // metas
            "meta_keys"     => "required|array",
            "meta_keys.*"   => "required|string",
            "meta_vals"     => "required|array",
            "meta_vals.*"   => "required|string",

            'action'       => 'required|in:article',
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
