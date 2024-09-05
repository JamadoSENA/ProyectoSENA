<?php
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
$validar = $_SESSION['correo'];

if ($validar == null || $validar == '') {
    header("Location: ../../../LogIn.php");
    die();
} 

// Obtener el nombre del usuario desde la base de datos
require("../../Configuration/Connection.php");

// Obtener el idUser del usuario actual
$sql_user = $conexion->query("SELECT idUser FROM users WHERE email = '$validar'");
$user_data = $sql_user->fetch_assoc();
$user_id = $user_data['idUser'];

// Obtener el nombre del usuario
$sql_name = $conexion->query("SELECT * FROM users WHERE idUser = $user_id");
$user_info = $sql_name->fetch_assoc();
$user_name = $user_info['nameU'];
$user_lastname = $user_info['lastname'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" width="auto" height="75" />
                    </a>
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="DoctorIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill"></i> <span class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li>
                            <a href="DoctorCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar"></i> <span class="ms-1 d-none d-sm-inline">Citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="DoctorDiagnosticos.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-prescription"></i> <span
                                    class="ms-1 d-none d-sm-inline">Diagnosticos</span> </a>
                        </li>
                        <li>
                            <a href="DoctorRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-book"></i> <span class="ms-1 d-none d-sm-inline">Recetas</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span
                                class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="Profile/Index.php">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../Configuration/SignOut.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-5">
                <div class="card text-center">
                    <div class="card-header">
                        ¡Bienvenido!
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Estimado/a <?php echo $user_name . ' ' . $user_lastname; ?>:</h5>
                        <p class="card-text">
                            Tienes la oportunidad de gestionar tus propias citas y tratamientos diagnosticados de manera
                            sencilla y rápida.
                            Aprovecha esta plataforma para organizar tu agenda, seguir el progreso de tus pacientes y
                            coordinar
                            tratamientos de manera eficiente.
                        </p>
                        <div class="container text-space-center">
                            <div class="row align-items-center">
                                <div class="col-4 d-flex justify-content-center align-items-center">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Gestión de Citas</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Agenda Cita</h5>
                                            <p class="card-text" style="text-align: justify;">
                                                Organiza tus citas de manera rápida y sencilla.
                                                Selecciona la fecha y hora que más te convenga y asegura tu espacio.
                                                Recibe recordatorios automáticos para que no te pierdas ninguna
                                                consulta.
                                            </p>
                                            <a href="DoctorCitas.php" class="btn btn-secondary">¡Agendar!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-center">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Registro de Diagnósticos</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Diagnóstico Médico</h5>
                                            <p class="card-text" style="text-align: justify;">
                                                Genera diagnósticos y recomendaciones médicas en un solo lugar.
                                                Mantén un registro detallado de cada consulta y organiza tu tiempo de
                                                manera efectiva.
                                                Puedes revisar los tratamientos recomendados en cualquier momento.
                                            </p>
                                            <a href="DoctorDiagnosticos.php" class="btn btn-secondary">¡Empezar!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-center">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Creación de Recetas</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Recetario</h5>
                                            <p class="card-text" style="text-align: justify;">
                                                Accede a las recetas y sigue el plan de medicación al pie de la letra.
                                                Consulta tus diagnosticos actuales y anteriores, y mantente al tanto
                                                de tus necesidades profesionales.
                                                Todo lo que necesitas para mejorar tu entorno laboral, en un solo lugar.
                                            </p>
                                            <a href="DoctorRecetas.php" class="btn btn-secondary">¡Recetar!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-body-secondary">
                        MediStock © 2024. Todos los derechos reservados.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>