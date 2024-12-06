<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Medication;
use App\Models\Assignment;
use App\Models\Diagnose;

class SummaryController extends Controller
{
    public function getCounts()
    {
        // Obtener los conteos de cada modelo utilizando el método count().
        $counts = [
            'doctors' => Doctor::count(), // Cuenta el número total de registros en la tabla `doctors`.
            'patients' => Patient::count(), // Cuenta el número total de registros en la tabla `patients`.
            'medications' => Medication::count(), // Cuenta el número total de registros en la tabla `medications`.
            'assignments' => Assignment::count(), // Cuenta el número total de registros en la tabla `assignments`.
            'diagnoses' => Diagnose::count(), // Cuenta el número total de registros en la tabla `diagnoses`.
        ];

        // Construir la respuesta en formato JSON.
        return response()->json([
            'message' => 'Resumen del sistema', // Mensaje descriptivo para indicar el propósito de la respuesta.
            'status' => 'success', // Estado de la operación, indicando que fue exitosa.
            'data' => $counts // Datos que incluyen los conteos obtenidos.
        ], 200); // Código HTTP 200 indicando que la operación fue exitosa.
    }
}
