<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Select_themsModel extends Model
{
    public $table = 'select_thems';
    protected $fillable = ['admin_id','form_id','id_thems'
    ];
    public $timestamps = false;

}
