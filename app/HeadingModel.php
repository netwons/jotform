<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadingModel extends Model
{
    public $table = 'heading';
    protected $fillable = ['admin_id','form_id','head_image','heading_text','sub_heading_text','heading_size','text_alignment','hide_field','created_at','updated_at'
    ];
}
