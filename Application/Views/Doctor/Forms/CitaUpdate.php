<?php 

require '../../../Configuration/Connection.php';

$id = $_POST['Cita'];
$estado = $_POST['Estado'];
$inicio = $_POST['Inicio'];
$paciente = $_POST['Paciente'];
$doctor = $_POST['Doctor'];

// Verificar si el paciente no es "Ninguno"
if ($paciente == '') {
    $paciente = 'NULL';
} else {
    $paciente = "'$paciente'";
}

// Verificar si ya existe una cita con la misma fecha y hora para el mismo paciente
$sql_check = "SELECT * FROM schedulings WHERE dateHourStart = '$inicio' AND fkIdPatient = $paciente AND idScheduling != $id";
$resultado_check = $conexion->query($sql_check);

if ($resultado_check->num_rows > 0) {
    // Si existe una cita duplicada, mostrar un mensaje de error
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
    // Si no hay duplicados, proceder con la actualización
    $sql = "UPDATE schedulings SET stateS='$estado',
                                  dateHourStart='$inicio',
                                  fkIdPatient=$paciente,
                                  fkIdDoctor='$doctor'
                                  WHERE idScheduling = $id";

    if ($conexion->query($sql)) {
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
                    window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>";
        exit;
    } else {
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
                    text: 'Ocurrió un error inesperado, intente más tarde.',
                    icon: 'error'
                }).then(function() {
                    window.location = '../DoctorCitas.php'; // Redirige después de cerrar el Swal
                });
            </script>
        </body>
        </html>" . $conexion->error;
    }
}

?>
