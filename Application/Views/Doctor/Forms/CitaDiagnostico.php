<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $queja = $_POST["queja"];
    $sintomas = $_POST["sintomas"];
    $antecedentesP = $_POST["antecedentesPersonales"];
    $antecedentesF = $_POST["antecedentesFamiliares"];
    $signos = $_POST["signos"];
    $examinacion =  $_POST["examinacion"];
    $observaciones = $_POST["observaciones"];
    $cita = $_POST["fkIdScheduling"];

    $insert_diagnosis = $conexion->prepare("CALL INSERTARDIAGNOSTICO(?, ?, ?, ?, ?, ?, ?)");
    $insert_diagnosis->bind_param("sssssssi", $queja, $sintomas, $antecedentesP, $antecedentesF,
    $signos, $examinacion, $observaciones, $cita);

        // Ejecutar la consulta de inserción
        if ($insert_diagnosis->execute()) {
            header("location:../DoctorDiagnosticos.php");
        } 
        // Cerrar la consulta de inserción
        $insert_diagnosis->close();

} 

?>