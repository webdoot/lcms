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
use Webdoot\Lcms\Models\Article;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'lcms_tags';

    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    // relation
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'lcms_article_tags', 'tag_id', 'article_id');
    }
}
