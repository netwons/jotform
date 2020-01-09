<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeModel extends Model
{
    public $table = 'change';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','do_i','url'
    ];
    public $timestamps = false;
}
