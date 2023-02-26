<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id('answersId');
            $table->unsignedBigInteger('examId');
            $table->unsignedBigInteger('questionId');
            $table->integer('selectedAnswerKey');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('examId')->references('examId')->on('exams');
            $table->foreign('questionId')->references('questionId')->on('quiz_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_answers');
    }
}
