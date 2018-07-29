<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestionAnswer extends Model
{
    protected $id = 'id';
    protected $table = 'survey_question_answers';
    protected $fillable = ['survey_id', 'question_id','name','number_of_selections','firebase_id'];
    public $timestamps = false;

    //relations
    public function survey() {
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function question() {
        return $this->belongsTo('App\SurveyQuestions', 'question_id');
    }
}
