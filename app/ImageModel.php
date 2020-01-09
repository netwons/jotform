<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    public $table = 'image';
    protected $fillable = ['admin_id','page_background_style','background_effect','font_family','background_color','previous_text_color','next_text_color','text_color'
    ];
    public $timestamps = false;
}
