<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class EventPost extends Model
{
    protected $id = 'id';
    protected $table = 'event_posts';

    public $timestamp = true;

    // relations

    // reverse relation for EventMobile by default and for EventBackend
    public function event($model = 'App\EventMobile')
    {
        return $this->belongsTo($model, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Users', 'user_id');
    }

    //quiries

    

    //localizations

    //attributes

    public function getPostAttribute($value)
    {

        $post = Helper::CleanStriptagText($value);
        return $post;
    }

}
