<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_StarModel extends Model
{
    protected $table='form_star';
    protected $fillable=['admin_id','form_id','created_at','updated_at'];

}
