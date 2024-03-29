<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'id';           // primary key
    protected $table = 'users';             // actual table name
    protected $dates = ['deleted_at', 'birthdate', 'last_login'];      // use soft deletes
    public $timestamps = true;              // to formate timestamps as dates

    public function getId()
    {
        return $this->id;
    }

    public function gender()
    {
        return $this->belongsTo('App\Genders', 'gender_id');
    }
    // public function info()
    // {
    //     return $this->HasOne('App\UserInfo', 'user_id');
    // }
    public function country()
    {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Cities', 'city_id');
    }

    public function rules()
    {
        return $this->belongsToMany('App\Rules', 'user_rules', 'user_id', 'rule_id');
    }

    public function eventCategories()
    {
        return $this->hasMany('App\Category', 'created_by');
    }

    public function events()
    {
        return $this->belongsToMany('App\EventBackend', 'user_going', 'user_id', 'event_id')->withPivot('is_accepted')->wherePivot('is_accepted', 1);
    }

    public function eventBackend()
    {
        return $this->hasMany('App\EventBackend', 'created_by');
    }
    public function eventMobile()
    {
        return $this->hasMany('App\EventMobile', 'created_by');
    }
    public function eventBooking()
    {
        return $this->hasMany('App\EventBooking', 'user_id');
    }
    public function eventPost()
    {
        return $this->hasMany('App\EventPost', 'user_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'user_interests', 'user_id', 'interest_id');
    }
    public function favoureite_events()
    {
        return $this->belongsToMany('App\EventBackend', 'user_favorites', 'user_id', 'item_id')->withPivot('name', 'entity_id');
    }
    public function CalenderEvents()
    {
        return $this->belongsToMany('App\EventBackend', 'user_calendars', 'user_id', 'event_id')->withPivot('from_date', 'to_date');

    }

    public static function UsersMobile()
    {
        return static::whereHas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->UserWithDeviceTokens()->get();
    }

    public function CurrentRule()
    {
        return  $this->rules[0]->nameMultilang;
    }

    public function IsBackEndUser()
    {
        return ($this->rules[0]->id == 1) ? true : false;
    }

    public function isSuperAdmin()
    {
        if($this->rules[0]->id == 3 && $this->rules[1]->id == 1 ||  $this->rules[0]->id == 1 && $this->rules[1]->id == 3)
        {
            return  true;
        }

        else
        {
            return false;
        }

    }

    public function isAdmin()
    {
        if($this->rules[0]->id == 7 && $this->rules[1]->id == 1 ||  $this->rules[0]->id == 1 && $this->rules[1]->id == 7)
        {
            return  true;
        }

        else
        {
            return false;
        }
    }

    // check if sponsor
    public function isSponsor()
    {
        foreach ($this->rules as $rule) {
            if ($rule->pivot->rule_id == 6) {
                return true;
            }
        }
        return false;

    }

    //Attributes
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    //Query Scopes
    public function scopeUserWithDeviceTokens($query)
    {
        return $query->whereNotNull("device_token");
    }

    // User Info
    public function userInfo()
    {
        return $this->hasOne('App\UserInfo', 'user_id');
    }
    //offers categories
    public function offer_cat()
    {
        return $this->hasMany('App\OfferCategory', 'created_by');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer', 'sponsor_id');
    }

    public function hisEvents()
    {
        return $this->hasMany('App\Event', 'created_by');
    }

    // get country name
    public function getCountry()
    {
        return isset($this->country->name) ? $this->country->name : __('keywords.not');
    }

    // get city name
    public function getCity()
    {
        return isset($this->city->name) ? $this->city->name : __('keywords.not');
    }

    // get region name
    public function getRegionName()
    {
        return isset($this->userInfo->region->name) ? $this->userInfo->region->name : __('keywords.not');
    }

    // get region id
    public function getRegionCityId()
    {
        return isset($this->userInfo->region->city_id) ? $this->userInfo->region->city_id : __('keywords.not');
    }



 public function sponsorCategories()
    {
    return $this->belongsToMany('App\SponsorCategory', 'user_sponsor_categories', 'user_id', 'sponsor_category_id');
    }


     public function sponsorCities()
    {
    return $this->belongsToMany('App\Cities', 'user_target_cities', 'user_id', 'city_id');
    }


     public function sponsorRegions()
    {
    return $this->belongsToMany('App\GeoRegion', 'user_target_regions', 'user_id', 'region_id');
    }
     public function sponsorSpecializations()
    {
    return $this->belongsToMany('App\Specialization', 'user_target_specializations', 'user_id', 'specialization_id');
    }
}
