<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestions extends Model
{
    protected $id = 'id';
    protected $table = 'survey_questions';
    protected $fillable = ['survey_id', 'name','firebase_id'];
    public $timestamps = false;

    //relations
    public function survey() {
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function answers()
    {
        return $this->hasMany('App\SurveyQuestionAnswer','question_id');
    }
}
