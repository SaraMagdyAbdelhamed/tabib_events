<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Interest;
use App\Entity;
use App\Helpers\Helper;

class EventMobile extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'events';
    protected $fillable = ['name', 'description', 'website', 'mobile', 'email', 'code', 'address', 'longtuide', 'latitude', 'venue', 'start_datetime', 'end_datetime', 'suggest_big_event', 'gender_id', 'age_range_id', 'is_paid', 'use_ticketing_system', 'is_active', 'event_status_id', 'rejection_reason'];
    public $timestamp = true;

    // relations
    public function user()
    {
        return $this->belongsTo('App\Users', 'created_by');
    }

    public function ticket()
    {
        return $this->hasMany('App\EventTicket', 'event_id');
    }

    public function bookedTicket()
    {
        return $this->hasMany('App\EventBookingTicket', 'event_id');
    }

    public function booking()
    {
        return $this->hasMany('App\EventBooking', 'event_id');
    }

    public function post()
    {
        return $this->hasMany('App\EventPost', 'event_id');
    }

    public function hashtags()
    {
        return $this->belongsToMany('App\EventHashtags', 'event_hash_tags', 'event_id', 'hash_tag_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\EventCategory', 'event_categories', 'event_id', 'interest_id');
    }

    public function media()
    {
        return $this->hasMany('App\EventMedia', 'event_id');
    }


    //quiries

    public static function getEventsMobile()
    {
        return static::query()->where('is_backend', '=', 0)
            ->select('events.*');

    }

    public static function CurrentEvents()
    {
        return static::query()->where('is_backend', '=', 0)->where('event_status_id', '=', 2)
            ->select('events.*');
    }

    public static function PendingEvents()
    {
        return static::query()->where('is_backend', '=', 0)->where('event_status_id', '=', 1)
            ->select('events.*');
    }

    public static function EventsRejected()
    {
        return static::query()->where('is_backend', '=', 0)->where('event_status_id', '=', 3)
            ->select('events.*');

    }

    public static function getCategory($category_id)
    {
        return Interest::find($category_id);
    }

    public static function BigEvent($id)
    {
        return static::query()->join('big_events', 'events.id', '=', 'big_events.event_id')
            ->where('event_id', $id)
            ->count();

    }

    //localizations

    public function getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('events', 'name', $this->id, 1) : Helper::localization('events', 'name', $this->id, 2);
        return ($result == null) ? $this->name : $result;
    }

    public function getVenueMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('events', 'venue', $this->id, 1) : Helper::localization('events', 'venue', $this->id, 2);
        return ($result == null) ? $this->venue : $result;
    }



    public static function arabic($field, $item_id)
    {

        $result = Helper::localization('events', $field, $item_id, 2);
        return $result;
    }




    public static function arabicHashtags($item_id)
    {

        $result = Helper::multi_localization(4, 'hashtag', $item_id, 2);
        return $result;
    }
}
