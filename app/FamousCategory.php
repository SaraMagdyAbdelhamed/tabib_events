<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamousCategory extends Model
{
    protected $id = 'id';
    protected $table = 'fa_categories';
    protected $fillable = ['name', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function attractions() {
        return $this->belongsToMany('App\FamousAttraction', 'famous_attractions', 'famous_attraction_id', 'category_id');
    }
}
