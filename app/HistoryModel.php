<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    public $table = 'historys';
    protected $fillable = ['admin_id','form_id','name','history'
    ];
    public $timestamps = false;
}
