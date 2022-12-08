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

class Media extends Model
{
    use HasFactory;

    protected $table = 'lcms_media';

    protected $fillable = [ 'user_id', 'url', 'alt', 'width', 'height', 'description' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
