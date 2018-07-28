<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'events';
    protected $fillable = [
        'name', 'description','image', 'website', 'mobile', 'email','tele_code',
        'code', 'address', 'longtuide', 'latitude', 'venue',
        'start_datetime', 'end_datetime', 'is_paid', 'use_ticketing_system',
        'is_active', 'show_in_mobile','created_by'
    ];
    protected $dates = ['start_datetime', 'end_datetime'];


    //Relations
    public function media() {
        return $this->hasMany('App\EventMedia', 'event_id');
    }

    public function owners() {
        return $this->belongsToMany('App\Users','event_owners', 'event_id','user_id');
    }

    public function categories() {
        return $this->belongsToMany('App\Category','event_categories', 'event_id','category_id');
    }

    public function specializations() {
        return $this->belongsToMany('App\Specialization','event_specializations', 'event_id','specialization_id');
    }

    public function workshops() {
        return $this->belongsToMany('App\Workshop','event_workshops', 'event_id','work_shop_id');
    }

    public function tickets() {
        return $this->hasMany('App\EventTicket', 'event_id');
    }

    public function surveys() {
        return $this->hasMany('App\Survey', 'event_id');
    }
}
