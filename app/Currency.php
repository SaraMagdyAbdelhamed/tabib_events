<?php

namespace App;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'currencies';
    protected $fillable = ['name', 'symbol', 'rate', 'def', 'subdivision_name', 'set_order'];
    public $timestamps = false;

//localization

    public function getSymbolAttribute($value)
    {
        $result = (\App::isLocale('en')) ? Helper::localization('currencies','symbol',$this->id,1) : Helper::localization('currencies','symbol',$this->id,2);
        return ($result==null)? $value : $result;
    }

    public function ticket() {
        return $this->hasMany('App\EventTicket', 'currency_id');
    }
}
