<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'period_id', 'subject', 'grade'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    protected static function booted()
    {
        static::saved(function ($grade) {
            $grade->student->calculateFinalGrade();
        });
    
        static::updated(function ($grade) {
            $grade->student->calculateFinalGrade();
        });
    
        static::deleted(function ($grade) {
            $grade->student->calculateFinalGrade();
        });
    }
}
