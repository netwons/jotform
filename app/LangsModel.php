<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LangsModel extends Model
{
    protected $table='langs';
    protected $fillable=[
      'name','title','rtl','flag_class'
    ];
    public $timestamps='false';
}
