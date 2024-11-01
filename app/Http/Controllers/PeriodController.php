<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{

    public function validadeData($request) {
        return $request->validate([
            'name' => 'required|string|max:255',
        ]);
    }

    public function index()
    {
        return response()->json(Period::all());
    }

    public function show($id)
    {
        $period = Period::findOrFail($id);
        return response()->json($period);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $period = Period::create($request->all());

        return response()->json($period, 201);
    }

    public function update(Request $request, Period $period)
    {
        $this->validadeData($request);

        $period->update($request->all());

        return response()->json($period, 200);
    }

    public function destroy($id)
    {
        $period = Period::findOrFail($id); 
        $period->delete(); 
        
        return response()->json(['message' => 'Período deletado com sucesso.'], 200);
    }
}
