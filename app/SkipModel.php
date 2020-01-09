<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkipModel extends Model
{
    public $table = 'skip';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','do_i','field'
    ];
    public $timestamps = false;
}
