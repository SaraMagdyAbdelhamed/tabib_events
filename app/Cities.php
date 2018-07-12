<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_cities';
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function users()
    {
        return $this->hasMany('App\Users', 'city_id');
    }
}
