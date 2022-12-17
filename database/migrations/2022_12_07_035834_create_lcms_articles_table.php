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
use Illuminate\Support\Facades\DB;

class CreateLcmsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcms_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('label')->nullable();
            $table->text('content')->nullable();
            $table->text('sub_content')->nullable();
            $table->text('images')->nullable();       // array
            $table->text('metas')->nullable();        // array
            $table->string('type', 50)->nullable();   // article|post|menu|slider|form
            $table->string('status', 50)->nullable(); // published|draft
            $table->string('owner')->nullable();        // {"user_id":1, "name":"Vikram", "role":"admin"}
            $table->dateTime('published_at')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('lcms_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcms_articles');
    }
}
