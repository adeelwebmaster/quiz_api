<?php

use App\Models\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id('examId');
            $table->unsignedBigInteger('quizId');
            $table->bigInteger('createdBy');
            $table->bigInteger('updatedBy');
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
        Schema::dropIfExists('exams');
    }
}
