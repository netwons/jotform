<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table='Admins';
    protected $fillable=[
      'name','email','password'
    ];
    public $timestamps=false;
}
