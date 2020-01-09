<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advanced_answerModel extends Model
{
    public $table='advanced_answerd';
    protected $fillable=['placeholder','readonly','hidefield','form_id','admin_id',
        'placeholder_email','default_value','read_only','hide_field','street_address1','street_address2',
        'city','state','zip_code','location','hide_field_address','area_code','phone',
        'read_only_phonenumber','hide_field_phonenumber','disable_past_date','read_only_datepicker','hide_field_datepicker',
        'read_only_timer','hide_field_timer','placeholder_short','default_value_short','read_only_short','hide_field_short',
        'placeholder_long_text','default_value_long_text', 'ready_only_long_text' , 'hide_field_long_text' ,
        'hide_field_text','multiple_select','shuffle_option','hide_field_dropdown','select_by_default','readonly_single_choice','hidefield_single_choice',
        'select_by_default_multi','ready_only_multi','hide_field_multi','ready_only_image','hide_field_image','placeholder_number',
        'default_value_number','readonly_number','hidefield_number','alternative_text','link_image','file_reference','hidefield_image','hidefield_fileupload',
        'hidefield_input','hidefield_emoji','default_value_start','hidefield_start','confirmation_text_box','time_field','minute_stepping',
        'time_format','default_time'


    ];
    public $timestamps=false;
}
