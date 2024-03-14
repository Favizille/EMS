<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q10',
        'answer_id'
    ];

    public function exam(){
        $this->belongTo(Exam::class, 'exam_id');
    }

    public function answer(){
        $this->hasOne(Answer::class, 'answer_id');
    }


}
