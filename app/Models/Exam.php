<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "code",
        "duration",
        "result_id",
        "user_id",
        "question_id",
        "answer_id",
    ];

    public function users(){
        $this->hasMany(User::class, 'user_id');
    }

    public function result(){
        $this->hasOne(Result::class, 'result_id');
    }

    public function question(){
        $this->hasMany(Question::class, 'question_id');
    }

    public function answer(){
        $this->hasMany(Answer::class, 'answer_id');
    }
}
