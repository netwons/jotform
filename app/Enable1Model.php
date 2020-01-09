<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enable1Model extends Model
{
    public $table = 'enable1';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','do_i','field'
    ];
    public $timestamps = false;
}
