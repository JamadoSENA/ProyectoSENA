<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $estado = $_POST["Estado"];
    $inicio = $_POST["Inicio"];
    $fin = $_POST["Fin"];
    $paciente = $_POST["Paciente"];
    $doctor = $_POST["Doctor"];

    $insert_scheduling = $conexion->prepare("CALL INSERTARCITA(?, ?, ?, ?, ?, ?, ?)");
    $insert_scheduling->bind_param("sssii", $estado, $inicio, $fin, $paciente, $doctor);

        // Ejecutar la consulta de inserción
        if ($insert_scheduling->execute()) {
            header("location:../DoctorAgenda.php");
        } 
        // Cerrar la consulta de inserción
        $insert_scheduling->close();

} 

?>