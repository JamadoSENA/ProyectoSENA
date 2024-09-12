<?php /*
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
*/
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
                        <li alt="Inicio">
                            <a href="PatientIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Citas Disponibles">
                            <a href="PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">
                                    Citas Disponibles</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="PatientMyCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar-check" alt="Citas"></i> <span
                                    class="ms-1 d-none d-sm-inline">Mis
                                    citas</span> </a>
                        </li>
                        <li>
                            <a href="PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule" alt="Recetas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    recetas</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="mt-auto dropdown pb-4">
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
            <div class="col py-3">
                <div class="card text-center">
                    <div class="card-header">
                        ¡Bienvenido/a <?php echo $user_name . ' ' . $user_lastname; ?>!
                    </div>
                    <div class="card-body">

                        <div class="container text-space-center">
                            <div class="row align-items-stretch">
                            <div class="col-4 d-flex justify-content-center align-items-stretch">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Citas Disponibles</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Agenda</h5>
                                            <p class="card-text">Organiza tus citas con tu médico de preferencia.</p>
                                            <a href="PatientCitas.php" class="btn btn-secondary">¡Agendar!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-stretch">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Mis Citas</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Mi Agenda</h5>
                                            <p class="card-text">Consulta y organiza tu tiempo a tu gusto.</p>
                                            <a href="PatientMyCitas.php" class="btn btn-secondary">¡Consultar!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-center align-items-stretch">
                                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Mis Recetas</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Mis Medicinas</h5>
                                            <p class="card-text">Accede a tus recetas y mejora tu salud.</p>
                                            <a href="PatientRecetas.php" class="btn btn-secondary">¡Consultar!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-4">
                            <!-- Canvas con un tamaño máximo -->
                            <div class="col-12 col-md-8 col-lg-6">
                                <canvas id="citas" style="width: 100%; height: 200%;"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctx = document.getElementById('citas');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
            datasets: [{
                label: '# de Citas',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>

</html>