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
    <link rel="shortcut icon" href="../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Diagnosticos</title>
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
                        <li>
                            <a href="DoctorIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill"></i> <span class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li>
                            <a href="DoctorCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar"></i> <span class="ms-1 d-none d-sm-inline">Citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="DoctorDiagnosticos.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-prescription"></i> <span
                                    class="ms-1 d-none d-sm-inline">Diagnosticos</span> </a>
                        </li>
                        <li>
                            <a href="DoctorRecetas.php" class="nav-link px-0 text-white align-middle">
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
                            <li><a class="dropdown-item" href="Profile/Index.php">Perfil</a></li>
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
                <div class="card">
                    <div class="card-header">
                        Gestion de Diagnosticos
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title" style="margin-top:8px">Tabla Diagnosticos</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="Create/Diagnostico.php" class="nav-link px-0 text-dark">
                                    <i class="fs-4 bi-plus-square"></i> <span class="ms-1 d-none d-sm-inline">Agregar
                                        Diagnostico</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="tablaPrescripciones" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">ID</th>
                                        <th scope="col" class="text-center">Fecha de Emisión</th>
                                        <th scope="col" class="text-center">Paciente</th>
                                        <th scope="col" class="text-center">ID Cita</th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    require("../../../Configuration/Connection.php");

                                    $sql = $conexion->query("SELECT 
                                                                diagnoses.idDiagnosis, 
                                                                diagnoses.dateHour AS fechaEmision, 
                                                                CONCAT(users.nameU, ' ', users.lastname) AS nombrePaciente, 
                                                                schedulings.idScheduling 
                                                            FROM 
                                                                diagnoses
                                                            JOIN schedulings ON diagnoses.fkIdScheduling = schedulings.idScheduling
                                                            JOIN users ON schedulings.fkIdPatient = users.idUser
                                                            WHERE schedulings.fkIdDoctor = $user_id");  // Aquí se filtran los diagnósticos por el id del doctor actual
                                
                                    while ($resultado = $sql->fetch_assoc()) { 
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $resultado['idDiagnosis']; ?></td>
                                        <td class="text-center"><?php echo $resultado['fechaEmision']; ?></td>
                                        <td class="text-center"><?php echo $resultado['nombrePaciente']; ?></td>
                                        <td class="text-center"><?php echo $resultado['idScheduling']; ?></td>
                                        <td class="text-center">
                                            <button class="btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-three-dots-vertical"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="Details/Diagnostico.php?idDiagnosis=<?php echo $resultado['idDiagnosis']?>"
                                                        class="dropdown-item">Detalles</a></li>
                                                <li><a href="Create/DiagnosticoReceta.php?idDiagnosis=<?php echo $resultado['idDiagnosis']?>"
                                                        class="dropdown-item">Generar Receta</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <?php 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Esta tabla muestra los diagnosticos disponibles.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#tablaPrescripciones').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>
