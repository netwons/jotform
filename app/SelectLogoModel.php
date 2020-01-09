<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectLogoModel extends Model
{
    public $table = 'selectlogo';
    protected $fillable = ['admin_id','form_id','selectlogo'
    ];
    public $timestamps = false;
}
