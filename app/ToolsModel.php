<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolsModel extends Model
{
    protected $table='tool';
    protected $fillable=[
        'name_en','name_fa','cat_id','submission','created_at','updated_at'
    ];
    //public $timestamps=false;
}
