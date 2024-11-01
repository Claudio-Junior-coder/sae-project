<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ra', 'email', 'responsible_id', 'class_id', 'final_grade', 'approval_status'];

    public function responsibles()
    {
        return $this->belongsTo(Responsible::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function behaviors()
    {
        return $this->hasMany(Behavior::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function calculateFinalGrade()
    {
        // Obtém as notas dos 4 trimestres e calcula a média
        $totalGrade = $this->grades()->sum('grade');
        $count = $this->grades()->count();

        if ($count == 4) { // Verifica se tem 4 notas de trimestres
            $this->final_grade = $totalGrade / 4;
            $this->approval_status = $this->final_grade >= 5 ? 'APROVADO' : 'REPROVADO';
            $this->save();
        }
    }
}
