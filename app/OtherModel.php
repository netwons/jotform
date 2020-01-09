<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherModel extends Model
{
    public $table='other';
    protected $fillable=['male','female','n_a','monday','tuesday','wednesday','thursday','friday','saturday'
        ,'sunday','january','february','march','april','may','june','july','august','september','october','november'
        ,'december','title','title_fa','form _status','form _status_fa','enabled','disabled','disabled_on_date',
        'disabled_on_submission_limit','disabled_on_date_and_submission_limit','expire_data','expire_data_fa',
        'warning_message','warning_message_fa','submission','submission_fa'
    ];
    public $timestamps=false;
}
