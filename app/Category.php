<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $id = 'id';
    protected $table = 'categories';
    protected $fillable = ['name', 'image' ,'created_by'];
    public $timestamps = true;

    
    // relations
    public function events() {
        return $this->belongsToMany('App\Event', 'event_categories');
    }
}
