<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributesModel extends Model
{
    protected $table='attributes';
    protected $fillable=[
        'name','name_en','name_fa','cat_en','cat_fa','type','options','desc_fa','desc_en','placeholder_en',
        'placeholder_fa'
    ];
    public $timestamps=false;
}
