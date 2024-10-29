<?php

namespace App\Http\Controllers;

use App\Models\Responsible;
use Illuminate\Http\Request;

class ResponsibleController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    }

    public function index()
    {
        return response()->json(Responsible::all());
    }

    public function show($id)
    {
        $period = Responsible::findOrFail($id);
        return response()->json($period);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $period = Responsible::create($request->all());

        return response()->json($period, 201);
    }

    public function update(Request $request, Responsible $period)
    {
        $this->validadeData($request);

        $period->update($request->all());

        return response()->json($period, 200);
    }

    public function destroy($id)
    {
        $period = Responsible::findOrFail($id); 
        $period->delete(); 
        
        return response()->json(['message' => 'Responsável deletado com sucesso.'], 200);
    }
}
