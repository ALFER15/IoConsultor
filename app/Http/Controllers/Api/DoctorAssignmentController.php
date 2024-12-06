<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorAssignmentController extends Controller
{

    public function unassignedDoctors()
    {
        // Consulta a la base de datos para obtener una lista de doctores que no tienen asignaciones.
        // La relación 'assignments' se define en el modelo Doctor y utiliza el método `doesntHave`
        // para buscar aquellos doctores que no tienen registros en la tabla relacionada.
        $doctors = Doctor::doesntHave('assignments')->get();

        // Verifica si la lista de doctores está vacía.
        // Si no hay doctores sin asignaciones, devuelve un mensaje indicando que todos los doctores
        // tienen asignaciones. Incluye un arreglo vacío en los datos.
        if ($doctors->isEmpty()) {
            return response()->json([
                'message' => 'Todos los doctores tienen asignaciones.', // Mensaje amigable para el cliente.
                'status' => 'success', // Indica que la solicitud fue exitosa.
                'data' => [] // Devuelve un arreglo vacío porque no hay resultados.
            ], 200); // Código HTTP 200 para indicar éxito.
        }

        // Si se encuentran doctores sin asignaciones, devuelve la lista de doctores junto con un mensaje.
        return response()->json([
            'message' => 'Doctores sin asignaciones encontradas.', // Mensaje que describe el resultado.
            'status' => 'warning', // Usa "warning" para indicar que hay algo relevante que revisar.
            'data' => $doctors // Incluye los datos de los doctores en el cuerpo de la respuesta.
        ], 200); // Código HTTP 200 para indicar éxito.
    }
}
