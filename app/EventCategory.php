<?php

namespace App;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $id = 'id';
    protected $table = 'categories';
    protected $fillable = ['event_id', 'category_id'];
    public $timestamps = false;

    
    // relations
    public function user() {
        return $this->belongsTo('App\Users', 'created_by');
    }

  
}
