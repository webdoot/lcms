<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $site =  [
            'site_title'        => 'required|string',
            'site_sub_title'    => 'nullable|string',
            'site_logo'         => 'required|string',
            'site_logo_2'       => 'nullable|string',
            'site_favicon'      => 'required|string',
        ];

        // $bank =  [
        //     'org_bank_account_name'   => 'sometimes|nullable|string|min:6|max:150',
        //     'org_bank_account_number' => 'sometimes|nullable|alpha_num|min:6|max:50',
        //     'org_bank_branch'         => 'sometimes|nullable|string|min:6|max:150',
        //     'org_bank_ifsc_code'      => 'sometimes|nullable|alpha_num|min:6|max:50',
        //     'org_bank_swift_code'     => 'sometimes|nullable|alpha_num|min:6|max:50',
        //     'org_bank_name'           => 'sometimes|nullable|string|min:6|max:150',
        // ];

       switch ($this->action) {
            case 'site' :  return $site ;  break;
        };
    }

    public function attributes()
    {
        return  [
            // 'org_name'                => 'Name',
            // 'org_address'             => 'Address',            
        ];
    }

}
