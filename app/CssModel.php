<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CssModel extends Model
{
    public $table = 'css';
    protected $fillable = ['admin_id','form_id','inject_custom_css'
    ];
    public $timestamps = false;
}
