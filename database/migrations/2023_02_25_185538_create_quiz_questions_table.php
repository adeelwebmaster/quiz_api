<?php

use App\Models\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id('questionId');
            $table->unsignedBigInteger('quizId');
            $table->text('question');
            $table->json('answers');
            $table->integer('rightAnswerKey');
            $table->boolean('isMandatory');
            $table->timestamps();

            //Foreign Key
            $table->foreign('quizId')->references('quizId')->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
}
