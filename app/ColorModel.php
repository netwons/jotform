<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    public $table = 'color';
    protected $fillable = ['admin_id','start_color','end_color','font_family','background_color','previous_text_color','next_text_color','text_color'
    ];
    public $timestamps = false;
}
