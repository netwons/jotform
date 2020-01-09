<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tools_AttributesModel extends Model
{
    public $table='tools_attributes';
    public $timestamps='false';
    protected $fillable=[
        'tool_id','attribute_id','default_value_en','default_value_fa','created_at','updated_at','admin_id'
    ];
}
