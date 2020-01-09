<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other_answerModel extends Model
{
    public $table='otheranswer';
    protected $fillable=['title','form_status','expire_date','submission','warning_message','form_id','admin_id','page_title','lang'
   ,'Continue_Forms_Later','encrypt_form_data','unique_submission' ];
    public $timestamps=false;
}
