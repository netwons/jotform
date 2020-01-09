<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    public $table = 'log';
    protected $fillable = ['user_id','ip','agent',
        'controller','method','input','output','route'
        ,'http_mode','browser','mobile_or_desktop','platform','created_at','updated_at'
    ];
    public $timestamps = true;
}
