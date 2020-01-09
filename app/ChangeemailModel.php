<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeemailModel extends Model
{
    public $table = 'changeemail';
    protected $fillable = ['form_id','admin_id','if_i','state','value','target','send','email'
    ];
    public $timestamps = false;
}
