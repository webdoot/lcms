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

class CreateLcmsArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcms_article_tags', function (Blueprint $table) {
            $table->id();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcms_article_tags');
    }
}