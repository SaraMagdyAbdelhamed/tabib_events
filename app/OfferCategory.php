<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class OfferCategory extends Model
{
    // Table attributes
    protected $primaryKey = 'id';
    protected $table = 'offer_categories';
    protected $fillable = ['name', 'image', 'created_by', 'updated_by'];
    public $timestamps = true;

    // Table relations
    
    public function offers()
    {
    return $this->belongsToMany('App\Offer');
    }

    public function user()
    {
        return $this->belongsTo('App\Users','created_by');
    }
    //Localization
     public function getNameMultilangAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('offer_categories', 'name', $this->id, 1) : Helper::localization('offer_categories', 'name', $this->id, 2);
        return ($result == null) ? $this->name : $result;
    }

}
