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
use Webdoot\Lcms\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'lcms_sub_categories';

    public $timestamps = false;

    protected $fillable = [ 'category_id', 'name', 'description' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
