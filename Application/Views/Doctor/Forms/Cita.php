<?php
require '../../../Configuration/Connection.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $paciente = $_POST["Paciente"];
    $inicio = $_POST["Inicio"];
    $estado = $_POST["Estado"];
    $doctor = $_POST["Doctor"];

    // Verificar que todas las variables están presentes
    if ($inicio && $estado && $doctor) {

        // Si paciente está vacío, usar NULL en la base de datos
        if (empty($paciente)) {
            $paciente = null;
        }

        // Si el paciente está presente, verificar si ya tiene una cita en la misma fecha
        if ($doctor) {
            $query_check = $conexion->prepare("SELECT COUNT(*) FROM schedulings WHERE fkIdDoctor = ? AND DATE(dateHourStart) = DATE(?)");
            $query_check->bind_param("is", $doctor, $inicio);
            $query_check->execute();
            $query_check->bind_result($count);
            $query_check->fetch();
            $query_check->close();

            if ($count > 0) {
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
                            text: 'Ya tienes una cita programada para la fecha digitada.',
                            icon: 'error'
                        }).then(function() {
                            window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                        });
                    </script>
                </body>
                </html>";
                exit();
            }
        }

        // Insertar la cita si no hay conflicto
        $insert_scheduling = $conexion->prepare("CALL INSERTARCITA( ?, ?, ?, ?)");
        $insert_scheduling->bind_param("ssii", $estado, $inicio, $paciente, $doctor);

        // Ejecutar la consulta de inserción
        if ($insert_scheduling->execute()) {
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
    } else {
        // Manejo de errores si faltan parámetros
        echo "Faltan datos del formulario.";
    }
}
?>
