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
$user_birthdate = htmlspecialchars($user_info['birthdate']);
$user_age = htmlspecialchars($user_info['age']);
$user_gender = htmlspecialchars($user_info['gender']);
$user_phoneNumber = htmlspecialchars($user_info['phoneNumber']);
$user_profession = htmlspecialchars($user_info['profession']);
$user_address = htmlspecialchars($user_info['addressU']);
$user_email = htmlspecialchars($user_info['email']);
$user_password = htmlspecialchars($user_info['passwordU']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Perfil</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" width="auto"
                        height="75" />
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li alt="Inicio">
                            <a href="../PatientIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Citas Disponibles">
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="bi bi-calendar fs-4"></i>
                                <span class="ms-1 d-none d-sm-inline">Citas Disponibles</span>
                            </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="bi bi-calendar-check fs-4"></i>
                                <span class="ms-1 d-none d-sm-inline">Mis citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="bi bi-capsule fs-4"></i>
                                <span class="ms-1 d-none d-sm-inline">Mis recetas</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person fs-4" alt="hugenerd"></i>
                            <span
                                class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="../Profile/Index.php">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../../../Configuration/SignOut.php">Cerrar Sesión</a>
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
                            <h5>Actualización de Datos</h5>
                            <input type="hidden" name="idUser" value="<?php echo $user_id; ?>">
                            <hr>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="validationCustom01">Nombre</label>
                                            <input type="text" class="form-control" value="<?php echo $user_name; ?>"
                                                disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom02">Apellido</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $user_lastname; ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom03">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control"
                                                value="<?php echo $user_birthdate; ?>" disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom04">Edad</label>
                                            <input type="number" class="form-control" value="<?php echo $user_age; ?>"
                                                disabled>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom05">Género</label>
                                            <input type="text" class="form-control" value="<?php echo $user_gender; ?>"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="validationCustom09">Correo Electrónico</label>
                                            <input type="email" class="form-control" value="<?php echo $user_email; ?>"
                                                name="Email" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese su dirección de correo.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom06">Número Telefónico</label>
                                            <input type="number" class="form-control"
                                                value="<?php echo $user_phoneNumber; ?>" name="NumeroTelefono" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese su número telefónico.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom07">Profesión</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $user_profession; ?>" name="Profesion" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese su profesión.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom08">Dirección</label>
                                            <input type="text" class="form-control" value="<?php echo $user_address; ?>"
                                                name="Direccion" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese su dirección.
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="validationCustom04">Contraseña</label>
                                            <input type="text" class="form-control"
                                                value="<?php echo $user_password; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary" type="submit">Actualizar</button>
                            <a href="../PatientIndex.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
</body>

</html>