<?php

/*
 |---------------------------------------------------
 | LARVEL CONTENT MANAGEMENT SYSTEM (LCMS)
 | WEBDOOT SOFTWARE DEVELOPEMT 
 |---------------------------------------------------
 */

namespace Webdoot\Lcms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webdoot\Lcms\Models\SubCategory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'lcms_categories';

    public $timestamps = false;

    protected $fillable = [ 'name', 'description' ];

}
