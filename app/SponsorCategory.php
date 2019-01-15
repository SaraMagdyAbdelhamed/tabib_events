<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class SponsorCategory extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sponsor_categories';
    protected $fillable = ['name', 'image', 'created_by', 'updated_by'];
    public $timestamps = true;

     //localization
    public function  getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('sponsor_categories','name',$this->id,1) : Helper::localization('sponsor_categories','name',$this->id,2);
        return ($result==null)? $this->name : $result;
    }


}

