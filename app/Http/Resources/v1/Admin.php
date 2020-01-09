<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Lang;

class Admin extends JsonResource
{
    public $token;
    public function  __construct($resource,$token)
    {
        $this->token=$token;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "username"=>$this->username,
            "mobile"=>$this->mobile,
            "phone"=>$this->phone,
            "disabled"=>$this->disabled,
            "created_at"=>$this->created_atcreated_at,
            "sidebar"=>$this->sidebar,
            "form_capacity"=>$this->form_capacity,
            "last_login"=>$this->last_login,
            "formcount"=>$this->formcount,
            "skin"=>$this->skin,
            "per_admins"=>$this->per_admins,
            "per_emails"=>$this->per_emails,
            "per_sms"=>$this->per_sms,
            "per_templates"=>$this->per_templates,
            "per_dashboard"=>$this->per_dashboard,
            'api_token'=>$this->token,


        ];
    }
}
