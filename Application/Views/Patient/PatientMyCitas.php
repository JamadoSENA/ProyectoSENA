<?php
session_start();
error_reporting(0);

// Verificar si el usuario está autenticado
$validar = $_SESSION['correo'];

if ($validar == null || $validar == '') {
    header("Location: ../../LogIn.php");
    die();
} 

// Obtener el nombre del usuario desde la base de datos
require("../../Configuration/Connection.php");

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
    <title>Mis Citas</title>
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
                        <li alt="Inicio">
                            <a href="PatientIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Citas Disponibles">
                            <a href="PatientCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar" alt="Citas"></i> <span class="ms-1 d-none d-sm-inline">
                                    Citas Disponibles</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="PatientMyCitas.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-calendar-check" alt="Citas"></i> <span
                                    class="ms-1 d-none d-sm-inline">Mis
                                    citas</span> </a>
                        </li>
                        <li>
                            <a href="PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule" alt="Recetas"></i> <span class="ms-1 d-none d-sm-inline">Mis
                                    recetas</span> </a>
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
                            <li><a class="dropdown-item" href="../../Configuration/SignOut.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-5">
                <div class="card">
                    <div class="card-header">
                        Mis Citas Programadas
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tabla Citas</h5>
                        <div class="table-responsive">
                            <table id="tablaCitas" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;"># de Cita</th>
                                        <th scope="col" style="text-align: center;">Estado</th>
                                        <th scope="col" style="text-align: center;">Fecha Inicio</th>
                                        <th scope="col" style="text-align: center;">Doctor</th>
                                        <th scope="col" style="text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
    require("../../Configuration/Connection.php");

    // Consulta para obtener las citas del paciente, incluyendo el nombre del doctor
    $sql = $conexion->query("
        SELECT s.idScheduling, s.stateS, s.dateHourStart, 
        CONCAT(d.nameU, ' ', d.lastname) AS doctorName
        FROM schedulings s
        JOIN users d ON s.fkIdDoctor = d.idUser
        WHERE s.fkIdPatient = $user_id
        AND s.stateS = 'Reservada'
        AND s.dateHourStart > NOW()
    ");

    while ($resultado = $sql->fetch_assoc()){
    ?>
                                    <tr>
                                        <td scope="row" style="text-align: center;">
                                            <?php echo $resultado['idScheduling']?></td>
                                        <td scope="row" style="text-align: center;"><?php echo $resultado['stateS']?>
                                        </td>
                                        <td scope="row" style="text-align: center;">
                                            <?php echo $resultado['dateHourStart']?></td>
                                        <td scope="row" style="text-align: center;">
                                            <?php echo $resultado['doctorName']?></td>
                                        <td scope="row">
                                            <div class="dropdown">
                                                <button class="btn" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots-vertical"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM9.5 3a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="dropdown-item cancel-button"
                                                            data-scheduling-id="<?php echo $resultado['idScheduling']?>"
                                                            data-date-start="<?php echo $resultado['dateHourStart']?>">Cancelar</a>
                                                    </li>
                                                    <li><a href="Details/Cita.php?idScheduling=<?php echo $resultado['idScheduling']?>"
                                                            class="dropdown-item">Detalles</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
    } 
    ?>
                                </tbody>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const cancelButtons = document.querySelectorAll('.cancel-button');

                                    cancelButtons.forEach(button => {
                                        button.addEventListener('click', function(event) {
                                            event.preventDefault();
                                            const schedulingId = this.dataset.schedulingId;
                                            const dateHourStart = new Date(this.dataset
                                                .dateStart);
                                            const currentDate = new Date();
                                            const differenceInHours = (dateHourStart -
                                                currentDate) / 1000 / 60 / 60;

                                            if (differenceInHours < 24) {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'No se puede cancelar',
                                                    text: 'No se puede cancelar la cita porque faltan menos de 24 horas para la misma.',
                                                    confirmButtonText: 'Entendido'
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'question',
                                                    title: '¿Estás seguro?',
                                                    text: '¿Deseas cancelar esta cita?',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Sí, cancelar',
                                                    cancelButtonText: 'No, mantenerla'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href =
                                                            'Update/Cita.php?idScheduling=' +
                                                            schedulingId;
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                                </script>

                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Esta tabla muestra las citas disponibles.
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    new DataTable('#tablaCitas', {
        layout: {
            topStart: {
                buttons: ['excel', 'pdf']
            }
        },
        pageLength: 5
    });
    </script>
</body>

</html>