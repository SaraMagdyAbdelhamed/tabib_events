<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'interests';



    // relations
    public function eventCategory() {
        return $this->hasMany('App\EventCategory', 'interest_id');
    }
    public function interest()
    {
    	return $this->belongsTo('App\UsersInterest','interest_id');
    }

    //localization
    public function  getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? \App\Helpers\Helper::localization('interests','name',$this->id,1) : \App\Helpers\Helper::localization('interests','name',$this->id,2);
        return ($result==null)? $this->name : $result;
    }
}
