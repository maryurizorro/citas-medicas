<?php
/**
 * Archivo de prueba para verificar la API
 * Ejecutar desde la línea de comandos: php test_api.php
 */

// Configuración
$baseUrl = 'http://localhost:8000/api';

// Función para hacer peticiones HTTP
function makeRequest($method, $url, $data = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data && in_array($method, ['POST', 'PUT'])) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'code' => $httpCode,
        'response' => json_decode($response, true)
    ];
}

// Función para mostrar resultados
function showResult($title, $result) {
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "🔍 $title\n";
    echo str_repeat("=", 50) . "\n";
    echo "Código HTTP: " . $result['code'] . "\n";
    echo "Respuesta: " . json_encode($result['response'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
}

echo "🚀 Iniciando pruebas de la API del Sistema de Citas Médicas\n";
echo "Base URL: $baseUrl\n";

// 1. Probar información de la API
$result = makeRequest('GET', $baseUrl);
showResult('Información de la API', $result);

// 2. Crear un médico
$medicoData = [
    'nombre' => 'Dr. Juan',
    'apellido' => 'García',
    'especialidad' => 'Cardiología',
    'email' => 'juan.garcia@hospital.com'
];
$result = makeRequest('POST', "$baseUrl/crearMedico", $medicoData);
showResult('Crear Médico', $result);

if ($result['code'] === 201) {
    $medicoId = $result['response']['id'];
    
    // 3. Obtener todos los médicos
    $result = makeRequest('GET', "$baseUrl/listarMedicos");
    showResult('Obtener Todos los Médicos', $result);
    
    // 4. Obtener médico específico
    $result = makeRequest('GET', "$baseUrl/medico/$medicoId");
    showResult("Obtener Médico ID: $medicoId", $result);
    
    // 5. Actualizar médico
    $updateData = [
        'especialidad' => 'Cardiología Intervencionista'
    ];
    $result = makeRequest('PUT', "$baseUrl/actualizarMedico/$medicoId", $updateData);
    showResult("Actualizar Médico ID: $medicoId", $result);
    
    // 6. Obtener médicos por especialidad
    $result = makeRequest('GET', "$baseUrl/medicosPorEspecialidad/Cardiología Intervencionista");
    showResult("Obtener Médicos por Especialidad", $result);
}

// 7. Crear un paciente
$pacienteData = [
    'nombre' => 'María',
    'apellido' => 'López',
    'email' => 'maria.lopez@example.com'
];
$result = makeRequest('POST', "$baseUrl/crearPaciente", $pacienteData);
showResult('Crear Paciente', $result);

if ($result['code'] === 201) {
    $pacienteId = $result['response']['id'];
    
    // 8. Obtener todos los pacientes
    $result = makeRequest('GET', "$baseUrl/listarPacientes");
    showResult('Obtener Todos los Pacientes', $result);
    
    // 9. Obtener paciente específico
    $result = makeRequest('GET', "$baseUrl/paciente/$pacienteId");
    showResult("Obtener Paciente ID: $pacienteId", $result);
    
    // 10. Actualizar paciente
    $updateData = [
        'email' => 'maria.lopez.updated@example.com'
    ];
    $result = makeRequest('PUT', "$baseUrl/actualizarPaciente/$pacienteId", $updateData);
    showResult("Actualizar Paciente ID: $pacienteId", $result);
}

// 11. Crear una cita (si tenemos médico y paciente)
if (isset($medicoId) && isset($pacienteId)) {
    $citaData = [
        'paciente_id' => $pacienteId,
        'medico_id' => $medicoId,
        'fecha' => date('Y-m-d\TH:i:s', strtotime('+1 day'))
    ];
    $result = makeRequest('POST', "$baseUrl/crearCita", $citaData);
    showResult('Crear Cita', $result);
    
    if ($result['code'] === 201) {
        $citaId = $result['response']['id'];
        
        // 12. Obtener todas las citas
        $result = makeRequest('GET', "$baseUrl/listarCitas");
        showResult('Obtener Todas las Citas', $result);
        
        // 13. Obtener cita específica
        $result = makeRequest('GET', "$baseUrl/cita/$citaId");
        showResult("Obtener Cita ID: $citaId", $result);
        
        // 14. Actualizar cita
        $updateData = [
            'estado' => 'confirmada'
        ];
        $result = makeRequest('PUT', "$baseUrl/actualizarCita/$citaId", $updateData);
        showResult("Actualizar Cita ID: $citaId", $result);
        
        // 15. Obtener citas pendientes
        $result = makeRequest('GET', "$baseUrl/citasPendientes");
        showResult("Obtener Citas Pendientes", $result);
        
        // 16. Obtener citas confirmadas
        $result = makeRequest('GET', "$baseUrl/citasConfirmadas");
        showResult("Obtener Citas Confirmadas", $result);
        
        // 17. Obtener citas por médico
        $result = makeRequest('GET', "$baseUrl/citasPorMedico/$medicoId");
        showResult("Obtener Citas por Médico", $result);
        
        // 18. Obtener citas por paciente
        $result = makeRequest('GET', "$baseUrl/citasPorPaciente/$pacienteId");
        showResult("Obtener Citas por Paciente", $result);
        
        // 19. Eliminar cita
        $result = makeRequest('DELETE', "$baseUrl/eliminarCita/$citaId");
        showResult("Eliminar Cita ID: $citaId", $result);
    }
}

// 20. Eliminar paciente
if (isset($pacienteId)) {
    $result = makeRequest('DELETE', "$baseUrl/eliminarPaciente/$pacienteId");
    showResult("Eliminar Paciente ID: $pacienteId", $result);
}

// 21. Eliminar médico
if (isset($medicoId)) {
    $result = makeRequest('DELETE', "$baseUrl/eliminarMedico/$medicoId");
    showResult("Eliminar Médico ID: $medicoId", $result);
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ Pruebas completadas\n";
echo str_repeat("=", 50) . "\n";
echo "Para ejecutar este archivo de prueba:\n";
echo "1. Asegúrate de que el servidor esté corriendo: php artisan serve\n";
echo "2. Ejecuta: php test_api.php\n";
echo "3. Revisa los resultados para verificar que todo funciona correctamente\n";
