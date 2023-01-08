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

class PostCreateRequest extends FormRequest
{
    public function authorize()
    {
        return Lcms::isUser();
    }

    public function rules()
    {
        return [
            'title'        => 'required|string',    
            'sub_title'    => 'nullable|string',
            'content'      => 'nullable|string',    
            'category_id'  => 'nullable|numeric',

            // metas
            "meta_keys"     => "sometimes|required|array",
            "meta_keys.*"   => "sometimes|required|string",
            "meta_vals"     => "sometimes|required|array",
            "meta_vals.*"   => "sometimes|required|string",

            'action'       => 'required|in:post',
        ];
    }

}
