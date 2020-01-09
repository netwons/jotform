<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsModel extends Model
{
    protected $table='sms';
    protected $fillable=['admin_id','name','sender','apikey','created_at','updated_at'];

}
