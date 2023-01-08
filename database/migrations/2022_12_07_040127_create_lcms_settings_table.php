<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLcmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value')->nullable();
        });


        /*
         * WARNING: Do not edit these settings. 
         * All editable item is provided throught setting page.
         */ 
        echo 'seeding setting...', PHP_EOL;
        DB::table('lcms_settings')->insert([                    
            [   
                'key' => 'site_title',                
                'value' => 'LCMS',
            ],
            [   
                'key' => 'site_sub_title',                
                'value' => 'Laravel Content Management System',
            ],
            [   
                'key' => 'site_logo',                
                'value' => '/vendor/lcms/logo.png',
            ],
            [   
                'key' => 'site_logo2',                
                'value' => '/vendor/lcms/logo-bg.png',
            ],
            [   
                'key' => 'site_favicon',                
                'value' => '/vendor/lcms/favicon.png',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcms_settings');
    }
}
