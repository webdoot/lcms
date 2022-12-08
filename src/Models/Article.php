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
use App\Models\User;
use Webdoot\Lcms\Models\Category;
use Webdoot\Lcms\Models\SubCategory;

class Article extends Model
{
    use HasFactory;

    protected $table = 'lcms_articles';

    protected $fillable = [ 'user_id', 'category_id', 'sub_category_id', 'title', 'title_2', 'title_3', 'content', 'content_2', 'images', 'metas', 'type', 'status', 'published_at' ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
