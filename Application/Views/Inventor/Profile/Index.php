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
                            <a href="../InventorMedicinas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule"></i> <span class="ms-1 d-none d-sm-inline">Medicinas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../InventorProveedores.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-person-circle"></i> <span
                                    class="ms-1 d-none d-sm-inline">Proveedores</span> </a>
                        </li>
                        <li>
                            <a href="../InventorRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-book"></i> <span class="ms-1 d-none d-sm-inline">Recetas</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span class="d-none d-sm-inline mx-1">Inventarista</span>
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.bootstrap5.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.bootstrap5.js"></script>

    <!-- JSZip (required for export buttons) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- pdfMake (required for PDF export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- DataTables Buttons Extensions -->
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript">
    new DataTable('#tablaMedicinas', {
        layout: {
            topStart: {
                buttons: ['excel', 'pdf']
            }
        }
    });
    </script>
</body>

</html>