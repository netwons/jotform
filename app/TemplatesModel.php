<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplatesModel extends Model
{
    protected $table='templates';
    protected $fillable=['name','admin_id','created_at','updated_at'];
}
