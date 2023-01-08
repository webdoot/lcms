<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required|string',

            "gallery"              => "sometimes|required|array",
            "gallery.*.image"      => "sometimes|required|string",
            "gallery.*.name"       => "sometimes|nullable|string",
            "gallery.*.description"=> "sometimes|nullable|string",

            'action'            => 'required|in:gallery',
        ];
    }

}
