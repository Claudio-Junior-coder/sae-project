<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $responsible = auth('responsible')->user(); // Obtém o responsável logado

        if (!$responsible) {
            return response()->json(['message' => 'Usuário não autenticado.'], 400);
        }

        // Obtém o aluno associado ao responsável logado e carrega os dados relacionados
        $student = Student::with(['grades.period', 'behaviors.period', 'activities.period'])
            ->where('responsible_id', $responsible->id)
            ->first();

        if (!$student) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

       
        return response()->json([
            'student' => $student->name,
            'grades' => $student->grades,
            'behaviors' => $student->behaviors,
            'activities' => $student->activities,
            'final_grade' =>  $student->final_grade,
            'approval_status' =>  $student->approval_status,
        ]);
    }

}
