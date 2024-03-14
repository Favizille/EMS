<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade',
        'score',
        'user_id',
        'exam_id',
    ];

    public function exam(){
        $this->hasOne(Exam::class, 'exam_id');
    }

    public function user(){
        $this->hasMany(User::class,'user_id');
    }
}
