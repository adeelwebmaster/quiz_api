<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\Quiz;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Save Exam in Database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  JSON
     */
    public function store(Request $request)
    {
        $postData = $request->json()->all();
        if(empty($postData['quizId']) || Quiz::find($postData['quizId']) == null)
        {
            $response = array(
                "success" => false,
                "errors" => array(5),
                "data" => null
            );
            return response()->json($response, 422, ["Content-Type"=> "application/json"]);
        }

        $answers = !empty($postData['answers'])? $postData['answers'] : [];
        unset($postData['answers']);
        
        $examModel = new Exam($postData);
        //User Id Who submit this exam
        $examModel->createdBy = 125;
        //User Id Who submit this exam
        $examModel->updatedBy = 125;
        if($examModel->save())
        {
            foreach($answers as $answer)
            {
                $answer['examId'] = $examModel->examId;
                $answerModel = new ExamAnswer($answer);
                $answerModel->save();
            }

            $responseData = Exam::find($examModel->examId);
            $responseData->answers = $responseData->exam_answers;
            unset($responseData->exam_answers);

            $response = array(
                "success" => true,
                "errors" => null,
                "data" => $responseData
            );
            return response()->json($response, 200, ["Content-Type"=> "application/json"]);
        };
    }

    /**
     * Get Exam By Id.
     *
     * @param  object  $exam
     * @return  JSON
     */
    public function show(Exam $exam)
    {
        $exam->answers = $exam->exam_answers;
        unset($exam->exam_answers);

        $response = array(
            "success" => true,
            "errors" => null,
            "data" => $exam
        );
        return response()->json($response, 200, ["Content-Type"=> "application/json"]);
    }
}
