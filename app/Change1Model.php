<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Change1Model extends Model
{
    public $table = 'change1';
    protected $fillable = ['if_i','state','value','target','do_i','url'
    ];
    public $timestamps = false;
}
