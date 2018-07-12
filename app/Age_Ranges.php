<?php

namespace App;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Age_Ranges extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'age_ranges';
    public $timestamps = false;



    //localization
    public function getNameAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('age_ranges','name',$this->id,1) : Helper::localization('age_ranges','name',$this->id,2);
        return ($result==null)? $value : $result;
    }
    
}
