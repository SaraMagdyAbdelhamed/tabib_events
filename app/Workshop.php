<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $id = 'id';
    protected $table = 'workshops';
    protected $fillable = ['name', 'description','venue','start_datetime','end_datetime'];
    protected $dates = ['start_datetime','end_datetime'];
    public $timestamps = false;

    public function events() {
        return $this->belongsToMany('App\Event','event_workshops', 'event_id','work_shop_id');
    }

    public function owners() {
        return $this->belongsToMany('App\Users','workshop_owners', 'workshop_id','user_id');
    }

    public function specializations() {
        return $this->belongsToMany('App\Specialization','workshop_specializations', 'workshop_id','specialization_id');
    }
}
