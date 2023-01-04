<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required|string',

            "slides"              => "sometimes|required|array",
            "slides.*.image"      => "sometimes|required|string",
            "slides.*.name"       => "sometimes|nullable|string",
            "slides.*.description"=> "sometimes|nullable|string",
            "slides.*.url"        => "sometimes|nullable|string",

            'action'            => 'required|in:slider',
        ];
    }

}
