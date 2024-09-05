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
require("../../../Configuration/Connection.php");

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
    <title>Proveedor</title>
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
                            <li><a class="dropdown-item" href="../../../Configuration/SignOut.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="card">
                    <h5 class="card-header">Informacion de Proveedor</h5>
                    <div class="card-body">
                        <?php 
                        
                        include ('../../../Configuration/Connection.php');
                        
                        $sql = "SELECT * FROM suppliers WHERE idSupplier=".$_GET['idSupplier'];
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        
                        ?>
                        <h5 class="card-title">Detalles</h5>
                        <form class="needs-validation" method="post" action="../Forms/ProveedorUpdate.php">
                            <h5>NIT</h5>
                            <input type="number" class="form-control" name="NIT"
                                value="<?php echo $row['idSupplier'] ?>" readonly>
                            <hr>
                            <div class="form-group">
                                <label for="validationCustom01">Nombre</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    value="<?php echo $row['nameSU']?>" name="Nombre" required>
                                <div class="invalid-feedback">
                                    Por favor digite el nombre del proveedor.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Direccion</label>
                                <input type="text" class="form-control" id="validationCustom02"
                                    value="<?php echo $row['addressSU']?>" name="Direccion" required>
                                <div class="invalid-feedback">
                                    Por favor digite la direccion del proveedor.
                                </div>
                            </div>
                            <hr>
                            <h5>Contacto</h5>
                            <div class="form-group">
                                <label for="validationCustom03">Email</label>
                                <input type="text" class="form-control" id="validationCustom03"
                                    value="<?php echo $row['email']?>" name="Correo" required>
                                <div class="invalid-feedback">
                                    Por favor digite el correo electronico del proveedor.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom04">Numero Telefonico</label>
                                <input type="number" class="form-control" id="validationCustom03"
                                 min="0" max="3999999999" value="<?php echo $row['phoneNumber']?>" name="Telefono" id="phoneNumber" required>
                                <div class="invalid-feedback" id="phone_feedback">
                                    Por favor, ingrese correctamente un número telefónico, que comience con 3.
                                </div>
                            </div>

                            <script>
                            document.getElementById('validationCustom03').addEventListener('input', function() {
                                const phoneNumber = this.value;
                                const feedback = document.getElementById('phone_feedback');

                                if (phoneNumber.length > 0 && phoneNumber.charAt(0) !== '3') {
                                    this.setCustomValidity('Número telefónico inválido. Debe comenzar con 3.');
                                    feedback.style.display = 'block';
                                } else {
                                    this.setCustomValidity('');
                                    feedback.style.display = 'none';
                                }
                            });
                            </script>


                            <hr>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="../InventorProveedores.php" class="btn btn-secondary">Cancelar</a>
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