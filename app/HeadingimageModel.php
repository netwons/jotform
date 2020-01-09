<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadingimageModel extends Model
{
    public $table = 'heading_image';
    protected $fillable = ['admin_id','form_id','head_image','heading_id'  ];
    public $timestamps = false;

}
