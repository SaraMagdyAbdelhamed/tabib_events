<?php

namespace App;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $id = 'id';
    protected $table = 'event_categories';
    protected $fillable = ['event_id', 'category_id'];
    public $timestamps = false;

    
    // relations
    public function user() {
        return $this->belongsTo('App\Users', 'created_by');
    }

    public function eventsbackend() {
        return $this->belongsToMany('App\EventBackend', 'event_categories', 'event_id', 'category_id');
    }

    public function eventsmobile() {
        return $this->belongsToMany('App\EventMobile', 'event_categories', 'event_id', 'interest_id');
    }
    public  function users()
    {
        return $this->belongsToMany('App\Users', 'user_interests','interest_id','user_id');
    }

     //localization
    public function  getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('interests','name',$this->id,1) : Helper::localization('interests','name',$this->id,2);
        return ($result==null)? $this->name : $result;
    }
}
