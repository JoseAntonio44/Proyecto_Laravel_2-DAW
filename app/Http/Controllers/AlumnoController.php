<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = DB::table('alumnos')->get();
        return response()->json($alumnos);
    }

    public function show($id)
    {
        $alumno = DB::table('alumnos')->find($id);
        
        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }
        
        return response()->json($alumno);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:32',
            'telefono' => 'nullable|string|max:16',
            'edad' => 'nullable|integer|min:0',
            'password' => 'required|string|max:64',
            'email' => 'required|email|max:64|unique:alumnos,email',
            'sexo' => 'required|string|in:M,F',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);

        $id = DB::table('alumnos')->insertGetId($data);
        
        return response()->json(['id' => $id, 'message' => 'Alumno creado'], 201);
    }

    public function update(Request $request, $id)
    {
        $alumno = DB::table('alumnos')->find($id);
        
        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:32',
            'telefono' => 'nullable|string|max:16',
            'edad' => 'nullable|integer|min:0',
            'password' => 'sometimes|string|max:64',
            'email' => 'sometimes|email|max:64|unique:alumnos,email,' . $id,
            'sexo' => 'sometimes|string|in:M,F',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        DB::table('alumnos')->where('id', $id)->update($data);
        
        return response()->json(['message' => 'Alumno actualizado']);
    }

    public function destroy($id)
    {
        $alumno = DB::table('alumnos')->find($id);
        
        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        DB::table('alumnos')->delete($id);
        
        return response()->json(['message' => 'Alumno eliminado']);
    }
}
