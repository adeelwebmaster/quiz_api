<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;
    protected $table = "quiz_questions";
    protected $primaryKey = "questionId";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "quizId",
        "question",
        "answers",
        "rightAnswerKey",
        "isMandatory",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "answers" => "array",
        "isMandatory" => "boolean"
    ];

    /**
     * The attributes are hidden.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
