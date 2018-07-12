<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamousAttraction extends Model
{
    protected $id = 'id';
    protected $table = 'famous_attractions';
    protected $fillable = ['name', 'address', 'longtuide', 'latitude', 'phone', 'info', 'is_active'];
    public $timestamps = false;


    // One to Many relation
    public function media() {
        return $this->hasMany('App\FamousAttractionMedia', 'famous_attraction_id');
    }

    // Many to Many relation between famous attractions & categories
    public function categories() {
        return $this->belongsToMany('App\FamousCategory', 'famous_attraction_categories', 'famous_attraction_id', 'category_id');
    }

    // Many to Many relations between 
    public function days() {
        // withPivot let object access additional pivot fields
        return $this->belongsToMany('App\FamousAttractionDays', 'famous_attraction_days', 'famous_attraction_id', 'day_id')->withPivot('from', 'to');
    }
}
