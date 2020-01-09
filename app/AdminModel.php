<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'username', 'password', 'mobile', 'phone', 'disabled', 'created_at', 'updated_at',
        'remember_token', 'sidebar', 'form_capacity', 'last_login', 'formcount',
        'skin', 'per_admins', 'per_emails', 'per_sms', 'per_templates', 'per_dashboard'
    ];


}
