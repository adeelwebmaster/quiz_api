<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;
    protected $table = "quizzes";
    protected $primaryKey = "quizId";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "description",
        "totalQuestions",
        "isPublished",
        "createdBy",
        "updatedBy"
    ];
    
    //Relationship
    public function quiz_questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class, "quizId", "quizId");
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "isPublished" => "boolean",
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
