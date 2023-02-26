<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;
    protected $table = "exams";
    protected $primaryKey = "examId";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "quizId",
        "createdBy",
        "updatedBy"
    ];
    
    //Relationship
    public function exam_answers(): HasMany
    {
        return $this->hasMany(ExamAnswer::class, "examId", "examId");
    }

    /**
     * The attributes are hidden.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "created_at",
        "updated_at",
    ];
}
