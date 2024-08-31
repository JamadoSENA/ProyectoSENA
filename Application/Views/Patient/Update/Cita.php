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
require_once("../../../../Configuration/Connection.php");

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
                        <li alt="Inicio">
                            <a href="../PatientIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Citas Disponibles">
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">
                                    Citas Disponibles</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar-check" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    citas</span> </a>
                        </li>
                        <li>
                            <a href="../PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule" alt="Recetas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    recetas</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person" alt="hugenerd" width="30" height="30"></i>
                            <span class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
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
                    <h5 class="card-header">Actualizacion de Cita</h5>
                    <div class="card-body">
                        <?php
                        
                        include ('../../../../Configuration/Connection.php');
                        
                        $sql = "SELECT * FROM schedulings WHERE idScheduling=".$_GET['idScheduling'];
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        
                        ?> 
                        <h5 class="card-title">Detalles</h5>
                        <hr>
                        <form class="needs-validation" method="post" action="../Forms/CitaUpdate.php" novalidate>
                        <input type="hidden" class="form-control" name="idScheduling" value="<?php echo $row['idScheduling'] ?>">
                            <div class="form-group">
                                <label for="validationCustom01">Estado</label>
                                <select name="Estado" class="form-control" id="validationCustom01" required>
                                    <option value="Reservada">Reservar</option>
                                    <option value="No Reservada">Cancelar</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite el estado de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Fecha Inicio</label>
                                <input type="datetime-local" class="form-control" id="validationCustom02"
                                    value="<?php echo $row['dateHourStart']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom03">Fecha Fin</label>
                                <input type="datetime-local" class="form-control" id="validationCustom03"
                                    value="<?php echo $row['dateHourEnd']?>" disabled>
                            </div>
                            <br>
                            <?php 
                                require("../../../../Configuration/Connection.php");

                                $idScheduling = $_GET['idScheduling'];

                                // Es importante utilizar declaraciones preparadas para evitar inyecciones SQL
                                $sql = "SELECT u.nameU, u.lastname
                                        FROM users u
                                        INNER JOIN schedulings s ON u.idUser = s.fkIdDoctor
                                        WHERE u.fkIdRole = 2 AND s.idScheduling = ?";

                                if ($stmt = $conexion->prepare($sql)) {
                                    $stmt->bind_param("i", $idScheduling);
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();

                                    $doctor_name = ''; // Inicializar la variable por si no se encuentra el doctor
                                    $doctor_lastname = ''; // Inicializar la variable por si no se encuentra el doctor

                                    if ($resultado && $resultado->num_rows > 0) {
                                        $row = $resultado->fetch_assoc();
                                        $doctor_name = $row['nameU'];
                                        $doctor_lastname = $row['lastname'];
                                    } 

                                    $stmt->close();
                                }

                                $conexion->close();
                                ?>
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <input type="text" class="form-control" id="doctor"
                                    value="<?php echo $doctor_name . ' ' . $doctor_lastname; ?>" disabled>
                            </div>
                            <input type="hidden" class="form-control" name="idPatient" value="<?php echo $user_id; ?>">
                            <hr>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="../PatientCitas.php" class="btn btn-secondary">Cancelar</a>
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