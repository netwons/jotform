<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    public $table = 'video';
    protected $fillable = ['admin_id','video_url','background_effect','font_family','background_color','previous_text_color','next_text_color','text_color'
    ];
    public $timestamps = false;
}
