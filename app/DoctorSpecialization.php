<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialization extends Model
{
    // Table attributes
    protected $id = 'id';
    protected $table = 'specializations';
    protected $fillable = ['name', 'created_by', 'updated_by', 'created_at', 'updated_at'];


    // Relations
    public function userInfo() {
        return $this->hasOne('App\UserInfo', 'specialization_id');
    }

    	public function events()
    {
        return $this->belongsToMany('App\EventBackend','event_specializations','specialization_id','event_id');
    }
}
