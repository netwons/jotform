<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoModel extends Model
{
    public $table = 'logo';
    protected $fillable = ['admin_id','form_id','upload','width','height','alignment','upload_url'
    ];
    public $timestamps = false;
}
