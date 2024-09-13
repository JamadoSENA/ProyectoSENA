<?php 
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
$validar = $_SESSION['correo'];

if ($validar == null || $validar == '') {
    header("Location: ../../../LogIn.php");
    die();
} 

// Obtener el nombre del usuario desde la base de datos
require("../../../Configuration/Connection.php");

// Obtener el idUser del usuario actual
$sql_user = $conexion->query("SELECT idUser FROM users WHERE email = '$validar'");
$user_data = $sql_user->fetch_assoc();
$user_id = $user_data['idUser'];

// Obtener el nombre del usuario
$sql_name = $conexion->query("SELECT nameU, lastname FROM users WHERE idUser = $user_id");
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
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" height="75" />
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li>
                            <a href="../DoctorIndex.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-house-door-fill"></i> <span
                                    class="ms-1 d-none d-sm-inline">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="../DoctorCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar"></i> <span class="ms-1 d-none d-sm-inline">Citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../DoctorDiagnosticos.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-prescription"></i> <span
                                    class="ms-1 d-none d-sm-inline">Diagnósticos</span>
                            </a>
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
                            <i class="fs-4 bi-person"></i>
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
                    <h5 class="card-header">Actualización de Cita</h5>
                    <div class="card-body">
                        <?php 
            include ('../../../Configuration/Connection.php');

            $sql = "SELECT * FROM schedulings WHERE idScheduling=".$_GET['idScheduling'];
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
            ?>

                        <h5 class="card-title">Detalles</h5>
                        <form class="needs-validation" method="post" action="../Forms/CitaUpdate.php" novalidate>
                            <input type="number" class="form-control" name="Cita"
                                value="<?php echo $row['idScheduling'] ?>" hidden>
                            <hr>

                            <!-- Estado -->
                            <div class="form-group">
                                <label for="validationCustom01">Estado</label>
                                <select name="Estado" class="form-control" id="validationCustom01" required
                                    onchange="updatePatientOptions()">
                                    <!-- Mostrar la opción seleccionada actualmente -->
                                    <option value="<?php echo $row['stateS']; ?>"><?php echo $row['stateS']; ?></option>

                                    <!-- Mostrar las opciones basadas en la condición -->
                                    <?php if ($row['stateS'] !== 'Reservada'): ?>
                                    <option value="Reservada">Reservada</option>
                                    <?php endif; ?>

                                    <?php if ($row['stateS'] !== 'No Reservada'): ?>
                                    <option value="No Reservada">No Reservada</option>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione el estado de la cita.
                                </div>
                            </div>
                            <br>

                            <!-- Fecha -->
                            <div class="form-group">
                                <label for="validationCustom02">Fecha</label>
                                <input type="datetime-local" class="form-control" id="validationCustom02"
                                    value="<?php echo $row['dateHourStart']?>" name="Inicio" required>
                                <div class="invalid-feedback">
                                    Por favor digite la fecha de inicio de la cita.
                                </div>
                            </div>
                            <br>

                            <!-- Paciente -->
                            <?php 
                require("../../../Configuration/Connection.php");

                $idScheduling = $_GET['idScheduling'];

                // Consulta para obtener los datos del paciente de la cita actual
                $sql = "SELECT u.nameU, u.lastname, u.idUser
                        FROM users u
                        INNER JOIN schedulings s ON u.idUser = s.fkIdPatient
                        WHERE s.idScheduling = $idScheduling";

                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();
                    $idPacienteActual = $row['idUser'];
                    $nombrePacienteActual = $row['nameU'];
                    $apellidoPacienteActual = $row['lastname'];
                }
                ?>

                            <div class="form-group">
                                <label for="patient">Paciente</label>
                                <select name="Paciente" class="form-control" id="validationCustom04">
                                    <!-- Mostrar la opción del paciente actual -->
                                    <option value="<?php echo $idPacienteActual; ?>">
                                        <?php echo $idPacienteActual . " - " . $nombrePacienteActual . " " . $apellidoPacienteActual; ?>
                                    </option>
                                    <!-- Consultar y mostrar otros pacientes -->
                                    <?php 
                        $sql = $conexion->query("SELECT idUser, nameU, lastname FROM users WHERE fkIdRole=1 ORDER BY nameU ASC");

                        while ($resultado = $sql->fetch_assoc()) {
                            $idUser = $resultado['idUser'];
                            $nameU = $resultado['nameU'];
                            $lastnameU = $resultado['lastname'];

                            // Evitar duplicar la opción del paciente actual
                            if ($idUser != $idPacienteActual) {
                                echo "<option value='$idUser'>$idUser - $nameU $lastnameU</option>";
                            }
                        } 
                        ?>
                        
                                    <!-- Opción Ninguno cuando el estado es No Reservada -->
                                    <option value="" id="noneOption" style="display: none;">Ninguno</option>
                                </select>
                            </div>
                            <hr>
                            <input type="hidden" class="form-control" name="Doctor" value="<?php echo $user_id; ?>">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
            <script>
            function updatePatientOptions() {
                const estadoSelect = document.getElementById('validationCustom01');
                const pacienteSelect = document.getElementById('validationCustom04');
                const noneOption = document.getElementById('noneOption');

                if (estadoSelect.value === 'No Reservada') {
                    noneOption.style.display = 'block';
                    pacienteSelect.value = '';
                } else {
                    noneOption.style.display = 'none';
                }
            }

            document.getElementById('submitBtn').addEventListener('click', function(event) {
                const estadoSelect = document.getElementById('validationCustom01');
                const pacienteSelect = document.getElementById('validationCustom04');
                const estado = estadoSelect.value;
                const paciente = pacienteSelect.value;

                if (estado === 'Reservada' && paciente === '') {
                    event.preventDefault(); // Evita el envío del formulario
                    Swal.fire({
                        icon: 'warning',
                        title: 'Atención',
                        text: 'Debe seleccionar un paciente cuando el estado sea "Reservada".',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
            </script>
            <script>
            function updatePatientOptions() {
                const estadoSelect = document.getElementById('validationCustom01');
                const pacienteSelect = document.getElementById('validationCustom04');
                const noneOption = document.getElementById('noneOption');

                if (estadoSelect.value === 'No Reservada') {
                    noneOption.style.display = 'block';
                    pacienteSelect.value = '';
                } else {
                    noneOption.style.display = 'none';
                }
            }
            </script>

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