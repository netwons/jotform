<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_Tool_attributeModel extends Model
{
    protected $table='form_tool_attribute';
    protected $fillable=[
      'form_tool_id','attribute_id','value','created_at','updated_at'
    ];
}
