<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $id = 'id';
    protected $table = 'offers';
    protected $fillable = ['name', 'description', 'image_en', 'image_ar', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function getNameAttribute($value)
    {
        $result = (app('translator')->getLocale()=='en') ? Helpers::localization('offers','name',$this->id,1) : Helpers::localization('offers','name',$this->id,2);
        return ($result=='Error')? $value : $result;
    }

    public function getImageAttribute($value){
        
            $base_url = 'http://eventakom.com/eventakom_dev/public/';
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
