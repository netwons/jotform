<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorsModel extends Model
{
    public $table = 'colors';
    protected $fillable = ['admin_id','form_id','color_scheme','page_color','page_image','form_color','form_image','font_color','input_background'
    ];
    public $timestamps = false;
}
