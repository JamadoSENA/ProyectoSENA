<?php 

session_start();
error_reporting(0);

$validar = $_SESSION['correo'];

if( $validar == null || $validar = ''){

  header("Location: ../../LogIn.php");
  die();
  
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Paciente</title>
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
                        <li alt="Citas Disponibles">
                            <a href="PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">
                                    Citas Disponibles</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="PatientMyCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar-check" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    citas</span> </a>
                        </li>
                        <li>
                            <a href="PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule" alt="Recetas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    recetas</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span class="d-none d-sm-inline mx-1">Paciente</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../../Configuration/SignOut.php">Cerrar Sesion</a>
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
                        <h5 class="card-title">Estimado Paciente: </h5>
                        <p class="card-text">Tenes la oportunidad de gestionar tus citas médicas de manera sencilla y
                            rápida. Para comenzar, dirígete a la sección "Mis Citas", donde podrás consultar la
                            disponibilidad de nuestros profesionales médicos, seleccionar el horario que mejor se adapte
                            a tus necesidades y programar tus consultas de forma directa desde nuestra plataforma.
                            Además, en esta área podrás revisar tus citas agendadas, modificar o cancelar cualquier cita
                            si es necesario, y acceder a información detallada sobre cada profesional. Si tienes alguna
                            pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro
                            equipo de soporte que está disponible para ayudarte en todo momento. Tu bienestar es nuestra
                            prioridad, y estamos aquí para ofrecerte una experiencia cómoda y eficiente en la gestión de
                            tus consultas médicas.</p>
                            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>    
                        <a href="PatientCitas.php" class="btn btn-primary">¡Agendar!</a>
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