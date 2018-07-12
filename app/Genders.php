<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
class Genders extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'genders';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Users', 'gender_id');
    }
   //localization
    public function getNameAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('genders','name',$this->id,1) : Helper::localization('genders','name',$this->id,2);
        return ($result==null)? $value : $result;
    }
}
