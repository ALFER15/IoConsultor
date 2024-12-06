<?php


namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Listar todos los pacientes
    public function index()
    {
        $patients = Patient::with('assignments')->get(); // Incluye las relaciones con assignments
        return response()->json($patients, 200);
    }

    // Crear un nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'nullable|string|max:15',
            'age' => 'nullable|integer|min:0',
        ]);

        $patient = Patient::create($request->all());
        return response()->json($patient, 201); // 201 indica que fue creado
    }

    // Mostrar un paciente específico
    public function show($id)
    {
        $patient = Patient::with('assignments')->find($id);

        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        return response()->json($patient, 200);
    }

    // Actualizar un paciente
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'age' => 'nullable|integer|min:0',
        ]);

        $patient->update($request->all());
        return response()->json($patient, 200);
    }

    // Eliminar un paciente
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $patient->delete();
        return response()->json(['message' => 'Paciente eliminado'], 200);
    }
}
