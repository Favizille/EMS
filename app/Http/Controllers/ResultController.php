<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $exam;
    protected $result;

    public function __construct(Exam $exam, Result $result){
        $this->exam = $exam;
        $this->result = $result;
    }

    public function createResult(Request $request){
        $request->validate([
            'grade'=> 'required',
            'score'=> 'required',
            'user_id'=> 'required',
            'exam_id'=> 'required',
        ]);

        $resultData = [
            'grade' => $request->grade,
            'score' => $request->score,
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
        ];

        $resultCreated = $this->result->create($resultData);

        if(!$resultCreated){
            return [
                "status" => "failed",
                "status_code" => 409,
                "message" => "Result Failed to be created"
            ];
        }

        return [
            'staus' => 'success',
            "status_code" => 201,
            'message' => 'Result Created Successfully'
        ];
    }

    public function getResult($examId){
        $exam = $this->exam->find($examId);
        $result = $this->result->where('exam_id', $examId);
         
        if(!$exam){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Exam could not be found'
            ];
        }
         
        if(!$result){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Result could not be found'
            ];
        }

        return [
            'status' => 'success',
            'status_code' => 200,
            'result' =>$result,
            'exam' => $exam
        ];
    }
}
