<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tools_CategoriesModel extends Model
{
    protected $table='tools_categories';
    protected $fillable=['name_en','name_fa','created_at','updated_at','admin_id'];
}
