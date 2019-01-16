<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_cities';
    protected $fillable = ['name', 'country_id', 'application_id'];
    protected $appends = ['name'];
    public $timestamps = false;

    // Relations
    public function country()
    {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function users()
    {
        return $this->hasMany('App\Users', 'city_id');
    }

    public function regions()
    {
        return $this->hasMany('App\GeoRegion', 'city_id');
    }

    // Attributes
    public function getNameAttribute() {
        return \App::isLocale('en') ? $this->attributes['name'] : \Helper::localization('geo_cities', 'name', $this->id, 2, $this->attributes['name']);
    }
}
