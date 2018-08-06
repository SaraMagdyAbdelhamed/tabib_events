<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoRegion extends Model
{
    // Table attributes
    protected $primaryKey = 'id';
    protected $table = 'geo_regions';
    protected $appends = ['name'];
    protected $fillable = ['name', 'city_id', 'application_id'];

    /** Relations **/
    public function userInfo() {
        return $this->hasOne('App\UserInfo', 'region_id');
    }

    public function city() {
        return $this->belongsTo('App\Cities', 'city_id');
    }

    public function currentRegion($id) {
        return $this->id == $id ? true : false;
    }

    // Attributes
    public function getNameAttribute(){
        return \App::isLocale('en') ? $this->attributes['name'] : \Helper::localization('geo_regions', 'name', $this->id, 2, $this->attributes['name']);
    }
}
