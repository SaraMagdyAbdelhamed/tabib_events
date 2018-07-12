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
    protected $dates = ['deleted_at', 'birthdate'];      // use soft deletes
    public $timestamps = true;              // to formate timestamps as dates

    public function getId()
    {
        return $this->id;
    }

    public function gender()
    {
        return $this->belongsTo('App\Genders', 'gender_id');
    }

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
        return $this->hasMany('App\EventCategory', 'created_by');
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
        return $this->belongsToMany('App\EventCategory', 'user_interests', 'user_id', 'interest_id');
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
        foreach ($this->rules as $rule) {
            if ($rule->pivot->rule_id != 1) {
                $result = \App::isLocale('en') ? $rule->name : \Helper::localization('rules', 'name', $rule->id, 2);
                $rule = ($result == 'Error') ? $this->rules[0]->name : $result;
                return $rule;
            }
        }
    }

    public function IsBackEndUser()
    {
        return ($this->rules[0]->id == 1) ? true : false;
    }

    public function isSuperAdmin()
    {
        return ($this->rules[0]->id == 1 && $this->rules[1]->id == 3) ? true : false;
    }

    public function isAdmin()
    {
        return ($this->rules[0]->id == 1 && $this->rules[1]->id == 4) ? true : false;
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

}
