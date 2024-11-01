<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function validadeData($request) {
        return $request->validate([
            'student_id' => 'required',
            'period_id' => 'required',
            'description' => 'required|string|max:255',
            'type' => 'required|numeric|max:15',
        ]);
    }

    public function index()
    {
        return response()->json(Activity::all());
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return response()->json($activity);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);

        $activity = Activity::create($request->all());

        return response()->json($activity, 201);
    }

    public function update(Request $request, Activity $activity)
    {
        $this->validadeData($request);

        $activity->update($request->all());

        return response()->json($activity, 200);
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id); 
        $activity->delete(); 
        
        return response()->json(['message' => 'Atividade deletada com sucesso.'], 200);
    }
}
