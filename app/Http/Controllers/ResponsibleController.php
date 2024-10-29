<?php

namespace App\Http\Controllers;

use App\Models\Responsible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $responsible = Responsible::findOrFail($id);
        $responsible['password'] = '';
        return response()->json($responsible);
    }

    public function store(Request $request)
    {
        $this->validadeData($request);
        $request['password'] = Hash::make($request['password']);
        $responsible = Responsible::create($request->all());

        return response()->json($responsible, 201);
    }

    public function update(Request $request, Responsible $responsible)
    {
        $this->validadeData($request);

        $request['password'] = Hash::make($request['password']);
        $responsible->update($request->all());

        return response()->json($responsible, 200);
    }

    public function destroy($id)
    {
        $responsible = Responsible::findOrFail($id); 
        $responsible->delete(); 
        
        return response()->json(['message' => 'Responsável deletado com sucesso.'], 200);
    }
}
