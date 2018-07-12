<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopMedia extends Model
{
    protected $id = 'id';
    protected $table = 'shop_media';
    protected $fillable = ['shop_id', 'link','type'];
    public $timestamps = false;


    public function shop()
    {
    	return $this->belongsTo('App\Shop','shop_id');
    }
}
