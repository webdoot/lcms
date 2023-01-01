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

class CreateLcmsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcms_media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('alt')->nullable();
            $table->string('width', 50)->nullable();
            $table->string('height', 50)->nullable();
            $table->string('ext', 50)->nullable();     // Extension: jpg, mp4, pdf, doc
            $table->string('description')->nullable();  // short description
            $table->string('owner_id', 50)->nullable();      // Owners user_id
            $table->string('code', 50)->nullable();        // Article code

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcms_media');
    }
}
