<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderModel extends Model
{
    //public $timestamps='false';
    protected $table='folders';
    protected $fillable=[
      'name','admin_id','created_at','updated_at'
    ];
}
