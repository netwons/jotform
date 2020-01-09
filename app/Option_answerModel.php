<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option_answerModel extends Model
{
    public $table='option_answer';
    protected $fillable=[

       'form_id','admin_id','date','minute_stepping	','time_format','limit_time','default_time','limit_entry1','input_mask1',
        'entry_limits','options','option_single_choice','predefined_options','calculation_values','option_multiple_choice',
        'predefined_options_multiple','minumum','maximum','minumum_fileupload','maximumfileupload'
        ,'filetype','ratihn_style','lowest','rating_amount', 'lowest_rating_text','highest_rating',
        'allow_multiple_selection','image'
    ];
    public $timestamps=false;
}
