<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionanswerModel extends Model
{
    protected $fillable=[ 'submission_id','admin_id','answer',
    ];
    protected $table='submission_answers';
    public $timestamps=false;
}
