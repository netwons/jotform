<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_TollsModel extends Model
{
    protected $table='form_tools';
    protected $fillable=[
      'form_id','tool_id','tool_name','_index','created_at','updated_at','admin_id'
    ];
}
