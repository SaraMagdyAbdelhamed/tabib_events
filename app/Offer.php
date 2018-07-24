<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Offer extends Model
{
    protected $id = 'id';
    protected $table = 'offers';
    protected $fillable = ['name', 'description', 'image', 'image_ar', 'is_active', 'created_by', 'updated_by','start_datetime','end_datetime','sponsor_id'];
    public $timestamps = true;

    // public function getNameAttribute($value)
    // {
    //     $result = (app('translator')->getLocale()=='en') ? Helper::localization('offers','name',$this->id,1) : Helper::localization('offers','name',$this->id,2);
    //     return ($result=='Error')? $value : $result;
    // }

    public function getImageAttribute($value){
        
            $base_url = url('\/');
            $photo =($value =='' || is_null($value)) ? '':$base_url.$value;
            return $photo;
    }


    //Relations
    public function categories()
    {
    return $this->belongsToMany('App\OfferCategory', 'offer_offer_categories', 'offer_id', 'offer_category_id');
    }

    public function requests()
    {
    return $this->hasMany('App\OfferRequest','offer_id');
    }
}
