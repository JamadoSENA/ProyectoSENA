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
    <title>Cita</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
                            <a href="../DoctorIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill"></i> <span class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
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
                            <span
                                class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
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
                    <h5 class="card-header">Agendacion de Cita</h5>
                    <div class="card-body">
                        <h5 class="card-title">Formulario</h5>
                        <form class="needs-validation" method="post" action="../Forms/Cita.php" novalidate>
                            <div class="form-group">
                                <label for="validationCustom04">Paciente</label>
                                <select name="Paciente" class="form-control" id="validationCustom04"
                                    onchange="updateStatus()">
                                    <option value="">Ninguno</option>
                                    <?php 
            include ("../../../../Configuration/Connection.php");

            // Consulta para obtener usuarios con rol 1, ordenados por nombre
            $sql = $conexion->query("SELECT idUser, nameU, lastname FROM users WHERE fkIdRole=1 ORDER BY nameU ASC");

            // Recorre los resultados y genera las opciones del menú desplegable
            while ($resultado = $sql->fetch_assoc()) {
                $idUser = $resultado['idUser'];
                $nameU = $resultado['nameU'];
                $lastnameU = $resultado['lastname'];

                // Genera una opción en el menú desplegable con ID, nombre y apellido
                echo "<option value='$idUser'>$idUser - $nameU $lastnameU</option>";
            } 
            ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Fecha Inicio</label>
                                <input type="datetime-local" class="form-control" id="validationCustom02" name="Inicio"
                                    required onchange="updateEndDate()">
                                <div class="invalid-feedback">
                                    Por favor digite la fecha de inicio de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom03">Fecha Fin</label>
                                <input type="datetime-local" class="form-control" id="validationCustom03" name="Fin"
                                    required>
                                <div class="invalid-feedback">
                                    Por favor digite la fecha fin de la cita.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom01">Estado</label>
                                <select name="Estado" class="form-control" id="validationCustom01" disabled>
                                    <option value="No Reservada">No Reservada</option>
                                    <option value="Reservada">Reservada</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor digite el estado de la cita.
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <script>
                            // Function to validate the start date and time
                            function validateStartDate() {
                                const now = new Date();
                                const startDateInput = document.getElementById('validationCustom02');
                                const startDate = new Date(startDateInput.value);

                                if (startDate <= now || isNaN(startDate.getTime())) {
                                    alert('La fecha de inicio debe ser al menos una hora después de la hora actual.');
                                    startDateInput.value = '';
                                    return false;
                                }

                                return true;
                            }

                            // Function to set the end date one hour after the start date
                            function updateEndDate() {
                                if (!validateStartDate()) return;

                                const startDateInput = document.getElementById('validationCustom02');
                                const endDateInput = document.getElementById('validationCustom03');
                                const startDate = new Date(startDateInput.value);

                                // Set the end date to one hour after the start date
                                startDate.setHours(startDate.getHours() + 1);

                                // Format the date to match the input datetime-local format (YYYY-MM-DDTHH:MM)
                                const year = startDate.getFullYear();
                                const month = String(startDate.getMonth() + 1).padStart(2, '0');
                                const day = String(startDate.getDate()).padStart(2, '0');
                                const hours = String(startDate.getHours()).padStart(2, '0');
                                const minutes = String(startDate.getMinutes()).padStart(2, '0');
                                const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;

                                endDateInput.value = formattedDate;
                            }

                            // Function to update the status based on the patient selection
                            function updateStatus() {
                                const patientSelect = document.getElementById('validationCustom04');
                                const statusSelect = document.getElementById('validationCustom01');

                                if (patientSelect.value) {
                                    statusSelect.value = 'Reservada';
                                } else {
                                    statusSelect.value = 'No Reservada';
                                }
                            }

                            // Initialize the date and status when the page loads
                            document.addEventListener('DOMContentLoaded', function() {
                                updateEndDate(); // Set initial end date if the start date is provided
                                updateStatus(); // Set initial status based on the patient selection
                            });
                            </script>
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