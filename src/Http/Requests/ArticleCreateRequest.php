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
            'title'        => 'required|string',    
            'sub_title'    => 'nullable|string',
            'label'        => 'nullable|string',
            'content'      => 'nullable|string',    
            'sub_content'  => 'nullable|string',
            
            // tags
            "tags"         => "sometimes|required|array",
            "tags.*"       => "sometimes|required|numeric",

            // metas
            "meta_keys"     => "sometimes|required|array",
            "meta_keys.*"   => "sometimes|required|string",
            "meta_vals"     => "sometimes|required|array",
            "meta_vals.*"   => "sometimes|required|string",

            'action'       => 'required|in:article',
        ];
    }

}
