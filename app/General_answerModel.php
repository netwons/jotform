<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General_answerModel extends Model
{
    public $table = 'general_answer';
    protected $fillable = ['type_name','name', 'description',
        'requireds', 'label', 'firstname', 'lastname', 'email', 'admin_id', 'address1', 'address2', 'city', 'zip_code',
        'province', 'Area_Code', 'phone', 'form_id', 'updated_at', 'created_at', 'hour', 'minutes', 'discription_short_text',
        'discription_long_text', 'question_text','discription_dropdown','discription_single_choice',
        'discription_multiple_choice','discription_image_choice','number','description_image','question_image','image','alignment_image','fileupload','captcha',
        'input_table','emoji','Star_Rating','heading_text','sub_heading_text','previous','next','section_question'

    ];
    public $timestamps = true;
}
