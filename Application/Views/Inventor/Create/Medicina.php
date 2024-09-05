<?php
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
$validar = $_SESSION['correo'];

if ($validar == null || $validar == '') {
    header("Location: ../../../../LogIn.php");
    die();
} 

// Obtener el nombre del usuario desde la base de datos
require("../../../../Configuration/Connection.php");

// Obtener el idUser del usuario actual
$sql_user = $conexion->query("SELECT idUser FROM users WHERE email = '$validar'");
$user_data = $sql_user->fetch_assoc();
$user_id = $user_data['idUser'];

// Obtener el nombre del usuario
$sql_name = $conexion->query("SELECT * FROM users WHERE idUser = $user_id");
$user_info = $sql_name->fetch_assoc();
$user_name = htmlspecialchars($user_info['nameU']);
$user_lastname = htmlspecialchars($user_info['lastname']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Medicamento</title>
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
                            <a href="../InventorIndex.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-house-door-fill"></i> <span
                                    class="ms-1 d-none d-sm-inline">Inicio</span>
                            </a>
                        </li>
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
                            <span
                                class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
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
                    <h5 class="card-header">Registro de Medicamento</h5>
                    <div class="card-body">
                        <h5 class="card-title">Formulario</h5>
                        <form class="needs-validation" method="post" action="../Forms/Medicina.php" novalidate>
                            <div class="form-group">
                                <label for="validationCustom01">Nombre</label>
                                <input type="text" class="form-control" id="validationCustom01" name="Nombre" required>
                                <div class="invalid-feedback">
                                    Por favor digite el nombre original del empaque.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Formato</label>
                                <select name="Formato" class="form-control" id="validationCustom02" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Capsulas">Capsulas</option>
                                    <option value="Jarabes">Jarabes</option>
                                    <option value="Comprimidos">Comprimidos</option>
                                    <option value="Grajeas">Grajeas</option>
                                    <option value="Suspensiones">Suspensiones</option>
                                    <option value="Polvos">Polvos</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite el formato del medicamento.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom03">Cantidad</label>
                                <input type="number" class="form-control" id="validationCustom03" name="Cantidad" min=1
                                    max=200 required>
                                <div class="invalid-feedback">
                                    Por favor digite la cantidad de empaques del medicamento, la cantidad minima es de 1
                                    y la maxima es de 100.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom04">Estado</label>
                                <select name="Estado" class="form-control" id="validationCustom02" readonly>
                                    <option value="Disponible">Disponible</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom05">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="validationCustom05" name="FechaVencimiento"
                                    required>
                                <div class="invalid-feedback">
                                    Por favor digite una fecha de vencimiento válida. No puede ser menor o igual a la
                                    fecha actual.
                                </div>
                            </div>

                            <script>
                            document.getElementById('validationCustom05').addEventListener('input', function() {
                                var inputDate = new Date(this.value);
                                var currentDate = new Date();

                                // Set time to 00:00:00 for both dates to compare only the date part
                                currentDate.setHours(0, 0, 0, 0);
                                inputDate.setHours(0, 0, 0, 0);

                                if (inputDate <= currentDate) {
                                    this.setCustomValidity(
                                        'Fecha inválida. La fecha de vencimiento debe ser mayor a la fecha actual.'
                                        );
                                } else {
                                    this.setCustomValidity('');
                                }
                            });
                            </script>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Categoria</label>
                                <select name="Categoria" class="form-control" id="validationCustom02" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Analgesico">Analgesico</option>
                                    <option value="Anestesico">Anestesico</option>
                                    <option value="Ansiolitico">Ansiolitico</option>
                                    <option value="Antibiotico">Antibiotico</option>
                                    <option value="Anticolinergico">Anticolinergico</option>
                                    <option value="Anticonceptivo">Anticonceptivo</option>
                                    <option value="Anticonvulsico">Anticonvulsico</option>
                                    <option value="Antidepresivo">Antidepresivo</option>
                                    <option value="Antihelmintico">Antihelmintico</option>
                                    <option value="Antineoplastico">Antineoplastico</option>
                                    <option value="Antiparkinsoniano">Antiparkinsoniano</option>
                                    <option value="Antimicotico">Antimicotico</option>
                                    <option value="Antipiretico">Antipiretico</option>
                                    <option value="Antipsicotico">Antipsicotico</option>
                                    <option value="Antidoto">Antidoto</option>
                                    <option value="Broncodilatador">Broncodilatador</option>
                                    <option value="Cardiotonico">Cardiotonico</option>
                                    <option value="Citostatico">Citostatico</option>
                                    <option value="Hipnotico">Hipnotico</option>
                                    <option value="Hormonoterapico">Hormonoterapico</option>
                                    <option value="Quimioterapico">Quimioterapico</option>
                                    <option value="Relajante Muscular">Relajante Muscular</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite la categoria del medicamento.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom04">Proveedor</label>
                                <select name="Proveedor" class="form-control" id="validationCustom04" required>
                                    <option value="">Ninguno</option>
                                    <?php 
                include ("../../../../Configuration/Connection.php");

                $sql = $conexion->query("SELECT * FROM suppliers ORDER BY nameSU ASC");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['idSupplier']."'>".$resultado
                ['nameSU']."</option>";

                } 
                ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite el proveedor el medicamento.
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="../InventorMedicinas.php" class="btn btn-secondary">Cancelar</a>
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


</body>

</html>