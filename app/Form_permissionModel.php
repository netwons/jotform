<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form_permissionModel extends Model
{
   // public $timestamps='false';
    protected $table='form_permission';
    protected $fillable=[
        'form_id','admin_id','can_permission','can_view','can_insert','can_edit','can_delete',
        'can_export','can_edit_form','can_delete_form','can_answer','can_form_setting','create_at','updated_at'
    ];
}
