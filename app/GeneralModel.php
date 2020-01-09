<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralModel extends Model
{
    public $table = 'general';
    protected $fillable = ['name_en', 'name_fa', 'description_en', 'description_fa', 'left_en', 'left_fa', 'right_en', 'right_fa', 'top_en', 'top_fa', 'required_en',
        'required_fa', 'required', 'sublabels_en', 'sublabels_fa', 'sublabels', 'sublabel_firstname', 'sublabel_firstname_fa',
        'sublabel_lastname', 'sublabel_lastname_fa', 'sublabel_email','question','question_fa','image','image_fa', 'sublabel_email_fa', 'street_address1',
        'street_address2', 'city', 'postal/zip_code', 'state/province', 'street address1_fa', 'street address1_en',
        'city_fa', 'postal/zip_code_fa', 'state/province_fa', 'Area_Code', 'phone', 'Area_Code_fa', 'phone_fa', 'date', 'date_fa',
        'hour', 'minutes', 'hour_fa', 'minutes_fa', 'question_text', 'question_text_fa','heading_text','heading_text_fa',
        'sub_heading_text','sub_heading_text_fa','previous','previous_fa','next','next_fa','section_question','section_question_fa'

    ];
    public $timestamps = false;
}
