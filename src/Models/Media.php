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
use Webdoot\Lcms\Lcms;

class Media extends Model
{
    use HasFactory;

    protected $table = 'lcms_media';

    protected $fillable = [ 'name', 'url', 'alt', 'width', 'height', 'ext', 'description', 'owner_id', 'code' ];

    protected $appends = [ 'name_dsp', 'url_dsp' ];

    public function getNameDspAttribute()
    {   
        return $this->name ? mb_strimwidth($this->name, 0, 20, "...") : '' ;
    }

    public function getUrlDspAttribute()
    {   
        if (Lcms::mediaType($this->ext) == 'photo') {
        	return $this->url;
        }
        elseif (Lcms::mediaType($this->ext) == 'pdf') {
        	return '/vendor/lcms/image/pdf.png';
        }
        elseif (Lcms::mediaType($this->ext) == 'doc') {
        	return '/vendor/lcms/image/doc.png';
        }
    }

}
