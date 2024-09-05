<?php
// Requerir el archivo de conexión
require '../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $diagnostico = $_POST["fkIdDiagnosis"];
    $viaAdmin = $_POST["viaAdministracion"];
    $dias = $_POST["dias"];
    $meses = $_POST["meses"];
    $horas = $_POST["horas"];
    $cantidades = $_POST["cantidades"];
    $estado =  $_POST["estado"];
    $instrucciones = $_POST["instrucciones"];
    $medicamento = $_POST["fkIdMedicine"];

    $insert_recipe = $conexion->prepare("CALL INSERTARRECETA(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_recipe->bind_param("sssssssii", $viaAdmin, $dias, $meses, $horas, $cantidades,
    $estado, $instrucciones, $medicamento, $diagnostico);

        // Ejecutar la consulta de inserción
        if ($insert_recipe->execute()) {
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
                        window.location = '../DoctorRecetas.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
            exit;
        } 
        // Cerrar la consulta de inserción
        $insert_recipe->close();

} 

?>