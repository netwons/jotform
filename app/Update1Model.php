<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update1Model extends Model
{
    public $table = 'update1';
    protected $fillable = ['if_i','state','value','target','do_i','from','to'
    ];
    public $timestamps = false;
}
