<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;
    protected $table = "exam_answers";
    protected $primaryKey = "answerId";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "examId",
        "questionId",
        "selectedAnswerKey",
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