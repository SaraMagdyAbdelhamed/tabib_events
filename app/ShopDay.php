<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopDay extends Model
{
     protected $id = 'id';
    protected $table = 'shop_days';
    protected $fillable = ['shop_id', 'day_id'];
    public $timestamps = false;


    public function shop()
    {
    	return $this->belongsTo('App\Shop','shop_id');
    }

    public function day()
    {
    	return $this->hasMany('App\Day','day_id');
    }
}
