<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PacienteController extends Controller
{

    public function index()
    {
        // Recuperar todos los pacientes de la tabla `patients` y devolverlos como una colección JSON.
        $patients = Patient::all(); // Recupera todos los registros de la tabla `patients`.
        return response()->json($patients, 200); // Responde con un código HTTP 200 indicando éxito.
    }

    /**
     * Crear un nuevo paciente y almacenarlo en la base de datos.
     *
     * @param Request $request La solicitud HTTP que contiene los datos del nuevo paciente.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con los datos del paciente creado.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada en la solicitud.
        $request->validate([
            'name' => 'required|string|max:255', // El nombre es obligatorio, debe ser un texto y tener un máximo de 255 caracteres.
            'email' => 'required|email|unique:patients,email', // El email es obligatorio, debe ser único en la tabla `patients`.
            'phone' => 'nullable|string|max:15', // El teléfono es opcional, pero si se proporciona, debe ser texto de hasta 15 caracteres.
            'age' => 'nullable|integer|min:0', // La edad es opcional, pero si se proporciona, debe ser un entero no negativo.
        ]);

        // Crear un nuevo paciente con los datos proporcionados en la solicitud.
        $patient = Patient::create($request->all()); // Inserta los datos en la base de datos.
        return response()->json($patient, 201); // Responde con un código HTTP 201 indicando que el recurso fue creado.
    }

    /**
     * Actualizar los datos de un paciente existente.
     *
     * @param Request $request La solicitud HTTP que contiene los datos actualizados.
     * @param int $id El ID del paciente a actualizar.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con los datos del paciente actualizado o un mensaje de error.
     */
    public function update(Request $request, $id)
    {
        // Buscar el paciente por su ID.
        $patient = Patient::find($id); // Realiza una búsqueda en la base de datos.

        // Verificar si el paciente existe.
        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404); // Responde con un mensaje y código HTTP 404 si no se encuentra.
        }

        // Validar los datos de entrada en la solicitud.
        $request->validate([
            'name' => 'required|string|max:255', // Validaciones similares a las de creación.
            'email' => 'required|email|unique:patients,email,' . $id, // Excluye el email del paciente actual al verificar unicidad.
            'phone' => 'nullable|string|max:15',
            'age' => 'nullable|integer|min:0',
        ]);

        // Actualizar los datos del paciente con la información proporcionada.
        $patient->update($request->all()); // Actualiza el registro en la base de datos.
        return response()->json($patient, 200); // Responde con los datos actualizados y un código HTTP 200 indicando éxito.
    }

    /**
     * Eliminar un paciente de la base de datos.
     *
     * @param int $id El ID del paciente a eliminar.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con un mensaje de éxito o error.
     */
    public function destroy($id)
    {
        // Buscar el paciente por su ID.
        $patient = Patient::find($id); // Realiza una búsqueda en la base de datos.

        // Verificar si el paciente existe.
        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404); // Responde con un mensaje y código HTTP 404 si no se encuentra.
        }

        // Eliminar el paciente de la base de datos.
        $patient->delete(); // Borra el registro de la base de datos.
        return response()->json(['message' => 'Paciente eliminado'], 200); // Responde con un mensaje de éxito y código HTTP 200.
    }
}
