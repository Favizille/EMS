<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $exam;

    public function __construct(Exam $exam){
        $this->exam = $exam;
    }

    public function createExam(Request $request){
        $request->validate([
            "title" => 'required',
            "code" => 'required',
            "duration" => 'required',
            "result_id" => 'required',
            "user_id" => 'required',
            "question_id" => 'required',
            "answer_id" => 'required',
        ]);

        $examDetails = [
            'title' => $request->input('title'),
            'code' => $request->input('code'),
            'duration' => $request->input('duration'),
            'result_id' => $request->input('result_id'),
            'user_id' => $request->input('user_id'),
            'question_id' => $request->input('question_id'),
            'answer_id' => $request->input('answer_id'),
        ];

        if(!$this->exam->create($examDetails)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Exam Failed to Create'
            ];
        }

        return [
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Exam Created Successfully'
        ];
    }

    public function getExam($examId){
        if(!$exam = $this->exam->find($examId)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Could not get User exam'
            ];
        }

        return [
            'status' => 'success',
            'status_code' => 200,
            'data' => $exam
        ];
    }


    public function updateExam($examId, Request $request){
        $exam = $this->exam->find($examId);
        if(!$exam){
            return [
                'status' =>'failed',
                'status_code' => 400,
                'message' => 'Exam Not Found',
            ];
        }

        $examDetails = [
            'title' => $request->input('title'),
            'code' => $request->input('code'),
            'duration' => $request->input('duration'),
            'result_id' => $request->input('result_id'),
            'user_id' => $request->input('user_id'),
            'question_id' => $request->input('question_id'),
            'answer_id' => $request->input('answer_id'),
        ];


       if(!$exam->update($examDetails)){
            return [
                "status" => "failed",
                "status_code" => 200,
                "message" => "Exam Update Failed"
            ];
       }

        return [
            'status' =>'success',
            'status_code' => 200,
            'data' => $exam,
        ];
    }

    public function deleteExam($examId){
        if(!$exam = $this->exam->find($examId)){
            return [
                "status" =>"failed",
                "status_code" =>400,
                "message" => "Exam Not Found"
            ];
        }

        $examDeleted = $exam->delete();

        if(!$examDeleted){
            return [
                "status" =>"failed",
                "status_code" =>400,
                "message" => "Exam wasn't deleted"
            ];
        }

        return [
            "status" =>"success",
            "status_code" =>200,
            "message" => "Deleted Succesfully"
        ];
    }
}
