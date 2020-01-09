<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValueModel extends Model
{
    protected $table='values';
    protected $fillable=['submission_id','form_tool_id','value','created_at','updated_at'];
}
