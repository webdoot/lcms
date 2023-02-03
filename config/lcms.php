<?php

return [

    /*
    |--------------------------------------------------
    | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
    | WEBDOOT SOFTWARE DEVELOPEMT 
    |--------------------------------------------------
    | Configuration paramer for this application
    | Usase : {{config('lcms.app_name')}}
    */


    /**
     * Application related setting needed for future information & updates. 
     * Note: Do not edit these settings, refer licence terms.
     */    
    'app_name'  => 'LCMS' ,

    'app_ver'   => '1.0' ,

    'app_db'    => '1.0' ,

    'app_home'   => 'https://webdoot.com/lcms',

    // Storage folder name in public direcory
    'storage'   => 'lcms_uploads',

    // User details
    'users'      => [
                        [
                            'user_id' => 1 ,
                            'name'    => 'Vikra Sh.' ,
                            'role'    => 'admin' ,
                        ], 

                        [
                            'user_id' => 2 ,
                            'name'    => 'Anil Kumar' ,
                            'role'    => 'member' ,
                        ],

                    ],

    // File details
    'media_types' => [
                        'photo' =>  ['jpg', 'jpeg', 'png', 'gif'], 
                        'video' =>  ['mp4', 'mpeg'], 
                        'pdf'   =>  ['pdf'], 
                        'doc'   =>  ['doc', 'docx', 'xls'], 
                    ],

    'admin_route' => 'lcms',

];