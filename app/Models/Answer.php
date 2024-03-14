<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'a1',
        'a2',
        'a3',
        'a4',
        'a5',
        'a6',
        'a7',
        'a8',
        'a9',
        'a10',
        'question_id'
    ];

    public function question(){
        $this->hasOne(Question::class, 'answer_id');
    }

    public function exam(){
        $this->belongsTo(Exam::class, 'exam_id');
    }
}
