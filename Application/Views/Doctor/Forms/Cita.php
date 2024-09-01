<?php
// Requerir el archivo de conexión
require '../../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $paciente = $_POST["Paciente"];
    $inicio = $_POST["Inicio"];
    $estado = $_POST["Estado"];
    $doctor = $_POST["Doctor"];

    // Verificar que todas las variables están presentes
    if ($paciente && $inicio && $estado && $doctor) {

        // Consulta para verificar si el paciente ya tiene una cita en la misma fecha
        $query_check = $conexion->prepare("SELECT COUNT(*) FROM schedulings WHERE fkIdPatient = ? AND DATE(dateHourStart) = DATE(?)");
        $query_check->bind_param("is", $paciente, $inicio);
        $query_check->execute();
        $query_check->bind_result($count);
        $query_check->fetch();
        $query_check->close();

        if ($count > 0) {
            header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registro Fallido</title>
            <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'El paciente seleccionado ya tiene una cita programada para la fecha digitada.',
                    icon: 'error'
                }).then(function() {
                    window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
        } else {
            // Insertar la cita si no hay conflicto
            $insert_scheduling = $conexion->prepare("CALL INSERTARCITA( ?, ?, ?, ?)");
            
            // Aquí el orden y tipo de los parámetros deben coincidir con los esperados por el procedimiento
            $insert_scheduling->bind_param("ssii", $estado, $inicio, $paciente, $doctor);

            // Ejecutar la consulta de inserción
            if ($insert_scheduling->execute()) {
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
                        text: 'La información se registro correctamente.',
                        icon: 'success'
                    }).then(function() {
                        window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                    });
                </script>
            </body>
            </html>";
                exit(); // Asegúrate de salir después de redirigir
            } else {
                // Manejo de errores
                header("Content-Type: text/html; charset=UTF-8");

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registro Fallido</title>
            <link rel='shortcut icon' href='../../../Resources/IMG/LogoHeadMediStock.png' type='image/x-icon'>
            <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        </head>
        <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js'></script>
            <script>
                Swal.fire({
                    title: '¡Error!',
                    text: 'Ocurrio un error inesperado, intente mas tarde.',
                    icon: 'error'
                }).then(function() {
                    window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>" . $insert_scheduling->error;
            }
            
            // Cerrar la consulta de inserción
            $insert_scheduling->close();
        }
    } else {
        // Manejo de errores si faltan parámetros
        echo "Faltan datos del formulario.";
    }
}
?>