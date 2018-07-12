<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_countries';
    public $timestamps = false;

         public function cities()
    {
        return $this->hasMany('App\Cities','country_id');
    }

        public function users()
    {
        return $this->hasMany('App\Users','country_id');
    }
}
