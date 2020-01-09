<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FontModel extends Model
{
    protected $table='font';
    protected $fillable=[
        'font','url_font'
    ];
}
