<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
class EventHashtags extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'hash_tags';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function event() {
        return $this->belongsToMany('App\EventBackend', 'event_hash_tags', 'event_id', 'hash_tag_id');
    }

     public function eventMobile() {
        return $this->belongsToMany('App\EventMobile', 'event_hash_tags', 'event_id', 'hash_tag_id');
    }
    //localizations
   public static function arabic($field,$item_id){

      $result = Helper::localization('hash_tags', $field, $item_id, 2);
      return $result;
    }
}
