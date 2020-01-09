<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Lang;

class AdminCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'data'=>$this->collection->map(function ($item){
              return [
                  'id'=>$item->id,
                  'name'=>$item->name,
                  "email"=>$item->email,
                  "username"=>$item->username,
                  "mobile"=>$item->mobile,
                  "phone"=>$item->phone,
                  "disabled"=>$item->disabled,
                  "created_at"=>$item->created_atcreated_at,
                  "sidebar"=>$item->sidebar,
                  "form_capacity"=>$item->form_capacity,
                  "last_login"=>$item->last_login,
                  "formcount"=>$item->formcount,
                  "skin"=>$item->skin,
                  "per_admins"=>$item->per_admins,
                  "per_emails"=>$item->per_emails,
                  "per_sms"=>$item->per_sms,
                  "per_templates"=>$item->per_templates,



              ]  ;
            }),
            "status"=>"success",
            "pages"=>'----------------------------------------------------'

        ];
    }
}
