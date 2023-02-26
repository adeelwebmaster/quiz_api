<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Save Quiz in Database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  JSON
     */
    public function store(Request $request)
    {
        $postData = $request->json()->all();
        if(empty($postData['title']) || empty($postData['isPublished']))
        {
            $response = array(
                "success" => false,
                "errors" => array(3, 4),
                "data" => null
            );
            return response()->json($response, 422, ["Content-Type"=> "application/json"]);
        }

        $questions = !empty($postData['questions'])? $postData['questions'] : [];
        unset($postData['questions']);
        
        $quizModel = new Quiz($postData);
        $quizModel->totalQuestions = count($questions);
        //User Id Who created this quiz
        $quizModel->createdBy = 123;
        //User Id Who created this quiz
        $quizModel->updatedBy = 123;
        if($quizModel->save())
        {
            foreach($questions as $question)
            {
                $question['quizId'] = $quizModel->quizId;
                $questionModel = new QuizQuestion($question);
                $questionModel->save();
            }

            $responseData = Quiz::find($quizModel->quizId);
            $responseData->questions = $responseData->quiz_questions;
            unset($responseData->quiz_questions);

            $response = array(
                "success" => true,
                "errors" => null,
                "data" => $responseData
            );
            return response()->json($response, 200, ["Content-Type"=> "application/json"]);
        };
    }

    /**
     * Get Quiz By Id.
     *
     * @param  object  $quiz
     * @return  JSON
     */
    public function show(Quiz $quiz)
    {
        $quiz->questions = $quiz->quiz_questions;
        unset($quiz->quiz_questions);

        $response = array(
            "success" => true,
            "errors" => null,
            "data" => $quiz
        );
        return response()->json($response, 200, ["Content-Type"=> "application/json"]);
    }
}
