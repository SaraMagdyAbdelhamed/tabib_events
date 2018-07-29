<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    // Table attributes
    protected $id = 'id';
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

}
