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

    protected $fillable = [ 'category_id', 'title', 'sub_title', 'label', 'content', 'sub_content', 'images', 'metas', 'type', 'status', 'owner', 'published_at' ];

    protected $casts = [
        'images'       => 'array',
        'metas'        => 'array',
        'owner'        => 'array',
        'published_at' => 'datetime',
    ];

    protected $appends = [ 'published_at_dsp', 'title_dsp', 'sub_title_dsp', 'label_dsp', 'content_dsp', 'sub_content_dsp', 'status_dsp', 'owner_name' ];

    public function getPublishedAtDspAttribute()
    {   // published at display
        return $this->published_at ? date('d-m-Y H:i:s', strtotime($this->published_at)) : '' ;
    }

    public function getImagesAttribute($value)
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

    public function getSubContentDspAttribute()
    {   
        return $this->sub_content ? mb_strimwidth(strip_tags($this->sub_content), 0, 70, "...") : '' ;
    }

    public function getStatusDspAttribute()
    {   
        if($this->status == 'published') {
            return ($this->getOwnerNameAttribute() ? $this->getOwnerNameAttribute(). ' | ' : ''). 'Published: '. $this->getPublishedAtDspAttribute();
        }
        else {
            return 'Draft' ;
        }
    }

    public function getOwnerNameAttribute()
    {   
        if ($this->owner) {
            return array_key_exists('name', $this->owner) ? $this->owner['name'] : '' ;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
