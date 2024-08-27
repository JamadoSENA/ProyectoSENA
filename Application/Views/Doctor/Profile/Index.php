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
    <title>Mi Perfil</title>
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
                            <li><a class="dropdown-item" href="Index.php">Perfil</a></li>
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
                    <h5 class="card-header">Información de Perfil</h5>
                    <div class="card-body">
                        <form class="needs-validation" method="post" action="../Forms/PerfilUpdate.php" novalidate>
                            <h5>Numero de Documento</h5>
                            <input type="number" class="form-control" value="<?php /*echo $row['idUser']*/ ?>" disabled>
                            <hr>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="validationCustom01">Nombre</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['nameU']*/ ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom02">Apellido</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['lastname']*/ ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom03">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control"
                                                value="<?php /*echo $row['birthdate']*/ ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom04">Edad</label>
                                            <input type="number" class="form-control"
                                                value="<?php /*echo $row['age']*/ ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom05">Genero</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['gender']*/ ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="validationCustom09">Correo Electronico</label>
                                            <input type="email" class="form-control"
                                                value="<?php /*echo $row['email']*/ ?>" name="Email" required>
                                            <div class="invalid-feedback">
                                                Por favor digite su direccion de correo.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom06">Numero Telefonico</label>
                                            <input type="number" class="form-control"
                                                value="<?php /*echo $row['phoneNumber']*/ ?>" name="NumeroTelefono"
                                                required>
                                            <div class="invalid-feedback">
                                                Por favor digite su numero telefonico.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom07">Profesión</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['profession']*/ ?>" name="Profesion" required>
                                            <div class="invalid-feedback">
                                                Por favor digite la profesion que desempeña.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom08">Dirección de Residencia</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['address']*/ ?>" name="Direccion" required>
                                            <div class="invalid-feedback">
                                                Por favor digite la direccion de residencia.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom10">Contraseña</label>
                                            <input type="text" class="form-control"
                                                value="<?php /*echo $row['password']*/ ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="../DoctorIndex.php" class="btn btn-secondary">Regresar</a>
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