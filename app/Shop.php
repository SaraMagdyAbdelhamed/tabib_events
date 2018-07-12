<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
   protected $id = 'id';
    protected $table = 'shops';
    protected $fillable = ['name', 'photo', 'phone', 'website', 'is_active', 'info','address','latitude','longitude'];
    public $timestamps = false;

    public function shop_branch()
    {
    	return $this->hasMany('App\ShopBranch','shop_id');
    }

     public function shop_day()
    {
    	return $this->hasMany('App\ShopDay','shop_id');
    }

     public function shop_media()
    {
        return $this->hasMany('App\ShopMedia','shop_id');
    }

    public function days()
    {
        return $this->belongsToMany('App\Day','shop_days','shop_id','day_id');
    }
}
