<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailsModel extends Model
{
    protected $table='emails';
    protected $fillable=['admin_id','name','host','port','username','password',
        'protocol','created_at','updated_at'


    ];
    //public $timestamps='false';
}
