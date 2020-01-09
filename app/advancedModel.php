<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advancedModel extends Model
{
    public $table='advanced';
    protected $fillable=['placeholder','placeholder_fa','readonly','readonly_fa','hidefield','hidefield_fa'
    ,'placeholder_email','placeholder_email_fa','default_value','default_value_fa','read_only','read_only_fa',
        'hide_field','hide_field_fa','placeholder_address','placeholder_address_fa','hide_field_address'
        ,'hide_field_address','placeholder_phonenumber','placeholder_phonenumber_fa','read_only_phonenumber','read_only_phonenumber_fa'
        ,'hide_field_phonenumber','hide_field_phonenumber_fa','disable_past_date','disable_past_date_fa'
        ,'read_only_datepicker','read_only_datepicker_fa','hide_field_datepicker','hide_field_datepicker_fa',
        'read_only_timer','read_only_timer_fa','hide_field_timer','hide_field_timer_fa','placeholder_short','placeholder_short_fa'
        ,'default_value_short','default_value_short_fa','read_only_short','read_only_short_fa','hide_field_short'
        ,'hide_field_short_fa','placeholder_long_text','placeholder_long_text_fa','default_value_long_text',
        'default_value_long_text_fa','ready_only_long_text','ready_only_long_text_fa','hide_field_long_text','hide_field_long_text',
        'multiple_select','multiple_select_fa','shuffle_option','shuffle_option_fa','select_by_default','select_by_default_fa',
        'alternative_text','alternative_text_fa','link_image','link_image_fa','file_reference','file_reference_fa'
        ,'confirmation_text_box','confirmation_text_box_fa','time_field','time_field_fa','minute_stepping','minute_stepping_fa',
        'time_format','time_format_fa','default_time','default_time_fa'
    ];
    public $timestamps=false;
}
