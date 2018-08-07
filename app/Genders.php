<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Genders extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'genders';
    protected $appends = ['name'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Users', 'gender_id');
    }
   //localization
    public function getNameAttribute($value)
    {
        return \App::isLocale('en') ? $this->attributes['name'] : Helper::localization('genders', 'name', $this->id, 2, $this->attributes['name']);
    }
}
