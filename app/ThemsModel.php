<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemsModel extends Model
{
    public $table = 'thems';
    protected $fillable = ['admin_id','form_id','thems','url_image'
    ];
    public $timestamps = false;
}
