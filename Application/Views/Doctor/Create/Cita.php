<?php 
/*
    session_start();
    error_reporting(0);

    $validar = $_SESSION['correo'];

    if( $validar == null || $validar = ''){

    header("Location: ../../../LogIn.php");
    die();
    
    }

*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cita</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" width="auto"
                        height="75" />
                    </a>
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="../DoctorCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar"></i> <span class="ms-1 d-none d-sm-inline">Citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../DoctorDiagnosticos.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-prescription"></i> <span
                                    class="ms-1 d-none d-sm-inline">Diagnosticos</span> </a>
                        </li>
                        <li>
                            <a href="../DoctorRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-book"></i> <span class="ms-1 d-none d-sm-inline">Recetas</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span class="d-none d-sm-inline mx-1">Doctor</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="../Profile/Index.php">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../../../Configuration/SignOut.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="card">
                    <h5 class="card-header">Agendacion de Cita</h5>
                    <div class="card-body">
                        <h5 class="card-title">Formulario</h5>
                        <form class="needs-validation" method="post" action="../Forms/Cita.php" novalidate>
                            <div class="form-group">
                                <label for="validationCustom01">Estado</label>
                                <select name="Estado" class="form-control" id="validationCustom01" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="No Reservada">No Reservada</option>
                                    <option value="Reservada">Reservada</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite el estado de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Fecha Inicio</label>
                                <input type="datetime-local" class="form-control" id="validationCustom02" name="Inicio" required>
                                <div class="invalid-feedback">
                                    Por favor digite la fecha de inicio de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom03">Fecha Fin</label>
                                <input type="datetime-local" class="form-control" id="validationCustom03" name="Fin" required> 
                                <div class="invalid-feedback">
                                    Por favor digite la fecha fin de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom04">Paciente</label>
                                <select name="Paciente" class="form-control" id="validationCustom04">
                                    <option value="">Ninguno</option>
                                    <?php /*
                include ("../../../../Configuration/Connection.php");

                $sql = $conexion->query("SELECT * FROM users WHERE fkIdRole=1 ORDER BY nameU ASC");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['idUser']."'>".$resultado
                ['nameU']."</option>";

                } */
                ?>
                                </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
</body>

</html>