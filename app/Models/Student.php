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
        // Agrupa as notas por trimestre usando 'period_id'
        $gradesByPeriod = $this->grades()->get()->groupBy('period_id');

        // Verifica se há 4 trimestres para realizar o cálculo da média final
        if ($gradesByPeriod->count() == 4) {
            $totalGrade = 0;

            // Calcula a média de cada trimestre
            foreach ($gradesByPeriod as $periodGrades) {
                $periodAverage = $periodGrades->avg('grade');
                $totalGrade += $periodAverage;
            }

            // Calcula a média anual com base nas médias trimestrais
            $this->final_grade = $totalGrade / 4;

            // Define o status de aprovação
            $this->approval_status = $this->final_grade >= 5 ? 'APROVADO' : 'REPROVADO';
            $this->save();
        }
    }

}
