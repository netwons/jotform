<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_RespondersModel extends Model
{
    protected $table='form_responders';
    protected $fillable=[
      'form_id','admin_id','subject','message','sms','teammate_message','teammate_subject',
        'admin_index','created_at','updated_at'
    ];
   // public $timestamps='false';
}
