<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    public $table='optionn';
    protected $fillable=['middle_name','middle_name_fa','prefix','prefix_fa','suffix','suffix_fa'
    ,'limit_entry','limit_entry_fa','disallow_free_addresses','disallow_free_addresses_fa','allow_specific_Domain',
        'allow_specific_Domain_fa','custom_country_list','custom_country_list_fa','default_country',
        'default_country_fa','state_optionss','state_optionss_fa','country_code','country_code_fa',
        'input_mask','input_mask_fa','default_date','default_date_fa','months','months_fa','days','days_fa',
        'today','today_fa','minute_stepping','minute_stepping_fa','time_format','time_format_fa','limit_time',
        'limit_time_fa','default_time','default_time_fa','24hour','24hour_fa','ampm','ampm_fa','both_ampm','both_ampm_fa',
        'am_only','am_only_fa','pm_only','pm_only_fa','none','none_fa','current','current_fa','custom','custom_fa',
        'limit_entry1','limit_entry1_fa','input_mask1','input_mask1_fa','entry_limits','entry_limits_fa','options','options_fa'
        ,'option_single_choice','option_single_choice_fa','predefined_options','predefined_options_fa','calculation_values',
        'calculation_values_fa','limit_entry_number','limit_entry_fa','limit_entry_fileupload','limit_entry_fileupload_fa'
        ,'file_type','file_type_fa','ratihn_style','ratihn_style_fa','lowest','lowest_fa','rating_amount','rating_amount_fa',
        'lowest_rating_text','lowest_rating_text_fa','highest_rating','highest_rating_fa',
        'allow_multiple_selection','allow_multiple_selection_fa','image','image_fa',
    ];
    public $timestamps=false;
}
