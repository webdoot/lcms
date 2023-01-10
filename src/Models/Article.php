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
// use Webdoot\Lcms\Models\Category;

class Article extends Model
{
    use HasFactory;

    protected $table = 'lcms_articles';

    protected $fillable = [ 'category_id', 'title', 'sub_title', 'label', 'content', 'sub_content', 'media', 'meta', 'type', 'owner_id', 'code', 'published_at' ];

    protected $casts = [
        'media'        => 'array',
        'meta'         => 'array',
        'published_at' => 'datetime',
    ];

    protected $appends = [ 'published_at_dsp', 'title_dsp', 'sub_title_dsp', 'label_dsp', 'content_dsp', 'content_json', 'sub_content_dsp', 'status_dsp', 'owner_name' ];

    public function getPublishedAtDspAttribute()
    {   // published at display
        return $this->published_at ? date('d-m-Y H:i:s', strtotime($this->published_at)) : '' ;
    }

    public function getMediaAttribute($value)
    {   // No image return empty array
        return $value ? json_decode($value) : [] ;
    }

    public function getTitleDspAttribute()
    {   
        return $this->title ? mb_strimwidth($this->title, 0, 38, "...") : '' ;
    }

    public function getSubTitleDspAttribute()
    {   
        return $this->sub_title ? mb_strimwidth($this->sub_title, 0, 38, "...") : '' ;
    }

    public function getLabelDspAttribute()
    {   
        return $this->label ? mb_strimwidth($this->label, 0, 38, "...") : '' ;
    }

    public function getContentDspAttribute()
    {   
        return $this->content ? mb_strimwidth(strip_tags($this->content), 0, 140, "...") : '' ;
    }

    public function getContentJsonAttribute()
    {   
        return $this->content ? json_decode($this->content) : [] ;
    }

    public function getSubContentDspAttribute()
    {   
        return $this->sub_content ? mb_strimwidth(strip_tags($this->sub_content), 0, 70, "...") : '' ;
    }

    public function getStatusDspAttribute()
    {   
        if($this->published_at) {
            return ($this->getOwnerNameAttribute() ? $this->getOwnerNameAttribute(). ' | ' : ''). 'Published: '. $this->getPublishedAtDspAttribute();
        }
        else {
            return 'Draft' ;
        }
    }

    public function getOwnerNameAttribute()
    {   
        if ($this->owner_id) {
            $users = config('lcms.users');
            $userid_name = array_column($users, 'name', 'user_id');

            // Find name listed for current user 
            return array_key_exists($this->owner_id, $userid_name) ? $userid_name[$id] : '' ;
        }
        else {
            return '';
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lcms_article_tags', 'article_id', 'tag_id');
    }
}
