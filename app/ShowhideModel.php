<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowhideModel extends Model
{
    public $table = 'show/hide';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','do_i','field'
    ];
    public $timestamps = false;
}
