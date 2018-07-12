<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class EventBackend extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'events';
    protected $fillable = [
        'name', 'description', 'website', 'mobile', 'email',
        'code', 'address', 'longtuide', 'latitude', 'venue',
        'start_datetime', 'end_datetime', 'suggest_big_event',
        'gender_id', 'age_range_id', 'is_paid', 'use_ticketing_system',
        'is_active', 'event_status_id', 'rejection_reason', 'show_in_mobile'
    ];
    protected $dates = ['start_datetime', 'end_datetime'];
    public $timestamp = true;

    // relations
    public function user()
    {
        return $this->belongsTo('App\Users', 'created_by');
    }

    // Many to Many relation between Events & Hashtags
    public function hashtags()
    {
        return $this->belongsToMany('App\EventHashtags', 'event_hash_tags', 'event_id', 'hash_tag_id');
    }

    // Many to Many relation between Events & Categories
    public function categories()
    {
        return $this->belongsToMany('App\EventCategory', 'event_categories', 'event_id', 'interest_id');
    }

    //Many to Many realtions with events and users in user_favourites
    public function users_favorites()
    {
        return $this->belongsToMany('App\Users', 'user_favorites', 'item_id', 'user_id')->withPivot('name', 'entity_id');
    }

    public function CalenderUsers()
    {
        return $this->belongsToMany('App\Users', 'user_calendars', 'event_id', 'user_id')->withPivot('from_date', 'to_date');
    }

    public function media()
    {
        return $this->hasMany('App\EventMedia', 'event_id');
    }

    public function scopeEventsStartAfterOneDay($query)
    {
        return $query->whereDate("start_datetime", '=', Carbon::now()->addDays(1)->toDateString());
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeShowInMobile($query)
    {
        return $query->where('show_in_mobile', 1);
    }
    //localization
    public function getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? \App\helpers\Helper::localization('events', 'name', $this->id, 1) : \App\helpers\Helper::localization('events', 'name', $this->id, 2);
        return ($result == null) ? $this->name : $result;
    }


    public function post() {
        return $this->hasMany('App\EventPost', 'event_id');
    }

    public function ticket() {
        return $this->hasMany('App\EventTicket', 'event_id');
    }

    public function bookedTicket() {
        return $this->hasMany('App\EventBookingTicket', 'event_id');
    }

    public function booking() {
        return $this->hasMany('App\EventBooking', 'event_id');
    }


}
