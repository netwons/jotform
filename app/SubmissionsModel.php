<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionsModel extends Model
{
    protected $fillable=[ 'submissions','form_id','ip','created_at','updated_at','fav','payment_status','payment',
        'payment_tool','transaction_id','ref_num','merchant_id','loginid','final_answer','admin_id'
    ];
    protected $table='submission';
   // public $timestamps=false;

}
