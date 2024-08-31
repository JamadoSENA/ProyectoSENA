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
                                <i class="fs-4 bi-calendar-check" alt="Citas"></i> <span
                                    class="ms-1 d-none d-sm-inline">Mis
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
                    <h5 class="card-header">Información de Cita</h5>
                    <div class="card-body">
                        <?php 
                        include ('../../../../Configuration/Connection.php');
                        
                        // Asegúrate de que idScheduling esté siendo pasado como parámetro
                        $idScheduling = isset($_GET['idScheduling']) ? intval($_GET['idScheduling']) : 0;
                        
                        if($idScheduling > 0) {
                            $sql = "SELECT * FROM schedulings WHERE idScheduling=$idScheduling";
                            $resultado = $conexion->query($sql);
                            $row = $resultado->fetch_assoc();

                            if ($row) {
                                // Consulta SQL corregida para obtener el nombre del doctor
                                $sql_doctor = "SELECT u.nameU, u.idUser
                                                FROM users u
                                                INNER JOIN schedulings s ON u.idUser = s.fkIdDoctor
                                                WHERE u.fkIdRole = 2 AND s.idScheduling = $idScheduling";
                                
                                $resultado_doctor = $conexion->query($sql_doctor);
                                $nombreDoctor = ''; // Inicializar la variable por si no se encuentra el doctor

                                if ($resultado_doctor && $resultado_doctor->num_rows > 0) {
                                    $row_doctor = $resultado_doctor->fetch_assoc();
                                    $nombreDoctor = $row_doctor['nameU'];
                                } else {
                                    $nombreDoctor = "Doctor no asignado";
                                }
                        ?>
                        <h5 class="card-title">Detalles</h5>
                        <form>
                            <hr>
                            <h5>ID Cita</h5>
                            <input type="number" class="form-control" value="<?php echo $row['idScheduling'] ?>"
                                disabled>
                            <hr>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Estado</label>
                                <input type="text" class="form-control" id="startDate"
                                    value="<?php echo $row['stateS']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="startDate">Fecha Inicio</label>
                                <input type="datetime-local" class="form-control" id="startDate"
                                    value="<?php echo $row['dateHourStart']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="endDate">Fecha Fin</label>
                                <input type="datetime-local" class="form-control" id="endDate"
                                    value="<?php echo $row['dateHourEnd']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <input type="text" class="form-control" id="doctor"
                                    value="<?php echo htmlspecialchars($nombreDoctor); ?>" disabled>
                            </div>
                            <hr>
                            <a href="../PatientCitas.php" type="button" class="btn btn-secondary">Regresar</a>
                        </form>
                        <?php 
                            } else {
                                echo "<p>No se encontraron detalles para la cita seleccionada.</p>";
                            }
                        } else {
                            echo "<p>ID de cita no válido.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
</body>

</html>
