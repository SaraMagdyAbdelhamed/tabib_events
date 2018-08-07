<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_countries';
    protected $appends = ['name'];
    public $timestamps = false;

    // Relations
    public function cities()
    {
        return $this->hasMany('App\Cities', 'country_id');
    }

    public function users()
    {
        return $this->hasMany('App\Users', 'country_id');
    }

    // Attributes
    public function getNameAttribute($value) {
        return \App::isLocale('en') ? $this->attributes['name'] : \Helper::localization('geo_countries', 'name', $this->id, 2, $this->attributes['name']);
    }
}
