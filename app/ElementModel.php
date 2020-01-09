<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementModel extends Model
{
    public $table = 'element';
    protected $fillable = ['admin_id','form_id','element','element_name','order'];
    public $timestamps = false;
}
