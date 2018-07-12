<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamousAttractionMedia extends Model
{
    protected $id = 'id';
    protected $table = 'famous_attraction_media';
    protected $fillable = ['famous_attraction_id', 'media', 'type'];
    public $timestamps = false;


    // Many to Many relation between Events & Hashtags
    public function categories() {
        return $this->belongsTo('App\FamousAttraction', 'famous_attraction_id');
    }
}
