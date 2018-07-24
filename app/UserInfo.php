<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    // Table attributes
    protected $id = 'id';
    protected $table = 'users_info';
    protected $fillable = [
        'user_id', 'mobile2', 'mobile3', 'region_id',
        'address', 'is_backend', 'is_profile_completed', 'specialization_id'
    ];

    
    /** Relations **/

    // One to One relation with Users model (single user has single info)
    public function user() {
        return $this->belongsTo('App\Users', 'user_id');
    }

    // One to One relation with GeoRegion model (single userInfo has single region)
    public function region() {
        return $this->belongsTo('App\GeoRegion', 'region_id');
    }

    // One to One relation with DoctorSpecialization model (single userInfo has single specialization)
    public function specialization() {
        return $this->belongsTo('App\DoctorSpecialization', 'specialization_id');
    }

    // Get region name
    public function getRegion($default) {
        return $this->region ? $this->region->name : $default;
    }

    // Get Doctor Specialization
    public function getSpecialization($default) {
        return $this->specialization ? $this->specialization->name : $default;
    }
}
