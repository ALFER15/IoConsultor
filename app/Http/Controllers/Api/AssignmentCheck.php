<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class AssignmentCheck extends Controller
{
    public function show($id)
    {
        // Busca al paciente en la base de datos usando el ID proporcionado.
        // Se utiliza el método `with` para cargar las asignaciones asociadas a ese paciente.
        // Dentro de las asignaciones, se seleccionan campos específicos:
        // - `id`: El identificador único de la asignación.
        // - `patient_id`: El identificador del paciente relacionado con la asignación.
        // - `doctor_id`: El identificador del médico asociado a la asignación.
        // - `diagnose_id`: El identificador del diagnóstico asignado.
        // - `medication_id`: El identificador del medicamento recetado.
        // - `date`: La fecha de la asignación.
        //
        // Además, se cargan las relaciones completas para cada asignación:
        // - `doctor`: Información detallada del médico asociado.
        // - `diagnose`: Información detallada del diagnóstico.
        // - `medication`: Información detallada del medicamento.
        $patient = Patient::with(['assignments' => function ($query) {
            $query->select('id', 'patient_id', 'doctor_id', 'diagnose_id', 'medication_id', 'date')
                  ->with(['doctor', 'diagnose', 'medication']);
        }])->find($id); // `find` busca el paciente usando su ID único.

        // Verifica si el paciente fue encontrado en la base de datos.
        // Si `find` devuelve `null`, significa que no existe un paciente con ese ID.
        // En este caso, responde con un mensaje de error en formato JSON y
        // un código HTTP 404 que indica "Recurso no encontrado".
        if (!$patient) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        // Si el paciente fue encontrado, se modifican las asignaciones cargadas
        // para agregar nombres descriptivos a partir de las relaciones.
        $patient->assignments = $patient->assignments->map(function ($assignment) {
            // Agrega el nombre del médico a la asignación.
            // Si no hay un médico asociado, asigna `null`.
            $assignment->doctor_name = $assignment->doctor ? $assignment->doctor->name : null;

            // Agrega el nombre del diagnóstico a la asignación.
            // Si no hay un diagnóstico asociado, asigna `null`.
            $assignment->diagnose_name = $assignment->diagnose ? $assignment->diagnose->name : null;

            // Agrega el nombre del medicamento a la asignación.
            // Si no hay un medicamento asociado, asigna `null`.
            $assignment->medication_name = $assignment->medication ? $assignment->medication->name : null;

            // Elimina los datos completos de las relaciones cargadas (médico, diagnóstico, medicamento)
            // para mantener el JSON más limpio y evitar redundancia en los datos enviados al cliente.
            unset($assignment->doctor, $assignment->diagnose, $assignment->medication);

            // Retorna la asignación modificada, que ahora incluye los nuevos campos agregados.
            return $assignment;
        });

        // Responde con un código HTTP 200 (éxito) y un objeto JSON que contiene
        // todos los detalles del paciente, incluyendo las asignaciones modificadas.
        return response()->json($patient, 200);
    }
}
