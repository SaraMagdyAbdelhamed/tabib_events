<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $id = 'id';
    protected $table = 'surveys';
    protected $fillable = ['name', 'event_id','is_realtime','firebase_id'];
    public $timestamps = true;


    //relations
    public function event() {
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function questions()
    {
        return $this->hasMany('App\SurveyQuestions','survey_id');
    }

    public function questions_answers()
    {
        return $this->hasMany('App\SurveyQuestionAnswer','survey_id');
    }
}
