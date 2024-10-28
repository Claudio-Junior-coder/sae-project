<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassromController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'name' => 'required|string|max:255',
        ]);
    }

    public function index()
    {
        return response()->json(Classroom::all());
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        return response()->json($classroom);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $classroom = Classroom::create($request->all());

        return response()->json($classroom, 201);
    }

    public function update(Request $request, Classroom $classroom)
    {
        $this->validadeData($request);

        $classroom->update($request->all());

        return response()->json($classroom, 200);
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id); 
        $classroom->delete(); 
        
        return response()->json(['message' => 'Classe deletada com sucesso.'], 200);
    }
}
