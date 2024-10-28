<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use Illuminate\Http\Request;

class BehaviorController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'student_id' => 'required',
            'period_id' => 'required',
            'comments' => 'required|string|max:255',
        ]);
    }

    public function index()
    {
        return response()->json(Behavior::all());
    }

    public function show($id)
    {
        $behavior = Behavior::findOrFail($id);
        return response()->json($behavior);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $behavior = Behavior::create($request->all());

        return response()->json($behavior, 201);
    }

    public function update(Request $request, Behavior $behavior)
    {
        $this->validadeData($request);

        $behavior->update($request->all());

        return response()->json($behavior, 200);
    }

    public function destroy($id)
    {
        $behavior = Behavior::findOrFail($id); 
        $behavior->delete(); 
        
        return response()->json(['message' => 'Comportamento deletado com sucesso.'], 200);
    }
}
