<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferOfferCategory extends Model
{
       // Table attributes
       protected $id = 'id';
       protected $table = 'offer_offer_categories';
       protected $fillable = ['offer_id', 'offer_category_id'];
       public $timestamps = false;
   
       // Table relations
}
