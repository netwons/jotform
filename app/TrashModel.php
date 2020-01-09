<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrashModel extends Model
{
    protected $table='trash';
    protected $fillable=['folder_id','name','disabled','width','color','ip_validation_type',
        'ips','background_type','default_background','template_id','lang','date_limit','submission_limit',
        'sms_sender','sms_apikey','email_id','sms_id','login_id','api_key','admin_id','unique_ft_id',
        'sms_message','email_message','email_subject','sms_ft_id','email_ft_id','created_at','updated_at',
        'folder_id','background_type'];
    public $timestamps=false;
}
