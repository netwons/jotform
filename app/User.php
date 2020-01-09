<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='admins';
    //public $timestamps=false;
    protected $fillable = [
        'name', 'email','username', 'password','api_token','remember_token','last_login',
        'mobile','phone','disabled','created_at','updated_at'
        ,'sidebar','form_capacity','formcount',
        'skin','per_admins','per_emails','per_sms','per_templates','per_dashboard'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];
    public function submissions()
    {
        return $this->hasMany(SubmissionsModel::class,'admin_id');
    }
    public function submission_answers()
    {
        return $this->hasMany(SubmissionanswerModel::class,'admin_id');
    }
    public function admin_last_view()
    {
        return $this->hasMany(AdminlastviewModel::class,'admin_id');
    }
    public function emails()
    {
        return $this->hasMany(EmailsModel::class,'admin_id');
    }
    public function folders()
    {
        return $this->hasMany(FolderModel::class,'admin_id');
    }
    public function forms()
    {
        return $this->hasMany(FormModel::class,'admin_id');
    }
    public function form_permission()
    {
        return $this->hasMany(Form_permissionModel::class,'admin_id');
    }
    public function form_responders()
    {
        return $this->hasMany(Form_RespondersModel::class,'admin_id');
    }
    public function form_star()
    {
        return $this->hasMany(Form_StarModel::class,'admin_id');
    }
    public function form_toolss()
    {
        return $this->hasMany(Form_TollsModel::class,'admin_id');
    }
    public function form_tool_attribute()
    {
        return $this->hasMany(Form_Tool_attributeModel::class,'admin_id');
    }
    public function sms()
    {
        return $this->hasMany(SmsModel::class,'admin_id');
    }
    public function templates()
    {
        return $this->hasMany(TemplatesModel::class,'admin_id');
    }

    public function tools()
    {
        return $this->hasMany(ToolsModel::class,'admin_id');
    }

    public function tools_attribute()
    {
        return $this->hasMany(Tools_AttributesModel::class,'admin_id');
    }

    public function tools_categorie()
    {
        return $this->hasMany(Tools_CategoriesModel::class,'admin_id');
    }

    public function values()
    {
        return $this->hasMany(ValueModel::class,'admin_id');
    }
    public function f()
    {
        return $this->hasMany(General_answerModel::class,'admin_id');
    }
    public function foption()
    {
        return $this->hasMany(Option_answerModel::class,'admin_id');
    }

    public function advance()
    {
        return $this->hasMany(advanced_answerModel::class,'admin_id');
    }
    public function other()
    {
        return $this->hasMany(Other_answerModel::class,'admin_id');
    }

    public function showhide()
    {
        return $this->hasMany(ShowhideAnswerModel::class,'admin_id');
    }

    public function update1()
    {
        return $this->hasMany(UpdateModel::class,'admin_id');

    }
    public function enable1()
    {
        return $this->hasMany(EnableModel::class,'admin_id');

    }
    public function skip1()
    {
        return $this->hasMany(SkipModel::class,'admin_id');

    }
    public function change1()
    {
        return $this->hasMany(ChangeModel::class,'admin_id');

    }
    public function changeemail1()
    {
        return $this->hasMany(ChangeemailModel::class,'admin_id');

    }
    public function color1()
    {
        return $this->hasMany(ColorModel::class,'admin_id');

    }






}
