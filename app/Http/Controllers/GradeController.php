<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'student_id' => 'required',
            'period_id' => 'required',
            'subject' => 'required|string|max:255',
            'grade' => 'required|numeric',
        ]);
    }

    public function index()
    {
        return response()->json(Grade::all());
    }

    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        return response()->json($grade);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $grade = Grade::create($request->all());

        return response()->json($grade, 201);
    }

    public function update(Request $request, Grade $grade)
    {
        $this->validadeData($request);

        $grade->update($request->all());

        return response()->json($grade, 200);
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id); 
        $grade->delete(); 
        
        return response()->json(['message' => 'Nota deletada com sucesso.'], 200);
    }
}
