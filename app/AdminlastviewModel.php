<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminlastviewModel extends Model
{
    protected $table='admin_last_view';
    protected $fillable=['admin-id','form_id','created_at','updated_at'];


}
