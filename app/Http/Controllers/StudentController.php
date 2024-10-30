<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'ra' => 'required|string|max:55',
            'responsible_id' => 'required',
            'class_id' => 'required',
        ]);
    }

    public function index()
    {
        return response()->json(Student::all());
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
         $this->validadeData($request);

        $student = Student::create($request->all());

        return response()->json($student, 201);
    }

    public function update(Request $request, Student $student)
    {
        $this->validadeData($request);

        $student->update($request->all());

        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id); 
        $student->delete(); 
        
        return response()->json(['message' => 'Aluno deletado com sucesso.'], 200);
    }
}
