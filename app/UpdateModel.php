<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateModel extends Model
{
    public $table = 'update';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','do_i','from','to'
    ];
    public $timestamps = false;
}
