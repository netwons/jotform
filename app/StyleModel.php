<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StyleModel extends Model
{
    public $table = 'style';
    protected $fillable = ['admin_id','form_id','form_width','label_alignment','question_spacing','label_width','font_id','font_size','button_style'
    ];
    public $timestamps = false;
}
