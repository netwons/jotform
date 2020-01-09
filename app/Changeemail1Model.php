<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Changeemail1Model extends Model
{
    public $table = 'changeemail1';
    protected $fillable = ['if_i','state','value','target','send','email'
    ];
    public $timestamps = false;
}
