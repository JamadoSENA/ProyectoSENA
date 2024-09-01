<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $cita = $_POST["Cita"];
    $queja = $_POST["queja"];
    $sintomas = $_POST["sintomas"];
    $antecedentesP = $_POST["antecedentesPersonales"];
    $antecedentesF = $_POST["antecedentesFamiliares"];
    $signos = $_POST["signos"];
    $examinacion =  $_POST["examinacion"];
    $observaciones = $_POST["observaciones"];

    $insert_diagnosis = $conexion->prepare("CALL INSERTARDIASNOSTICO(?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_diagnosis->bind_param("sssssssi", $queja, $sintomas, $antecedentesP, $antecedentesF,
    $signos, $examinacion, $observaciones, $cita);

        // Ejecutar la consulta de inserción
        if ($insert_diagnosis->execute()) {
            header("Content-Type: text/html; charset=UTF-8");

            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Registro Exitoso</title>
                <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
                <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
            </head>
            <body>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
                <script>
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'La información se registró correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../DoctorDiagnosticos.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
            exit;
        } 
        // Cerrar la consulta de inserción
        $insert_diagnosis->close();

} 

?>