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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Línea añadida para los íconos -->
    <title>Receta</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <hr>
                    <img src="../../../Resources/IMG/LogoSidebarMediStock.png" alt="MediStock" width="auto" height="75" />
                    <br>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <a href="../PatientIndex.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-house-door-fill"></i> <span class="ms-1 d-none d-sm-inline">Inicio</span> 
                            </a>
                        </li>
                        <li>
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar"></i> <span class="ms-1 d-none d-sm-inline">Citas Disponibles</span>
                            </a>
                        </li>
                        <li>
                            <a href="../PatientCitas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-calendar-check"></i> <span class="ms-1 d-none d-sm-inline">Mis citas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../PatientRecetas.php" class="nav-link px-0 text-white align-middle">
                                <i class="fs-4 bi-capsule"></i> <span class="ms-1 d-none d-sm-inline">Mis recetas</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-person"></i>
                            <span class="d-none d-sm-inline mx-1"><?php echo $user_name . ' ' . $user_lastname; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="../Profile/Index.php">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../../../Configuration/SignOut.php">Cerrar Sesion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="card">
                    <h5 class="card-header">Informacion de Receta</h5>
                    <div class="card-body">
                        <?php 
                        include ('../../../../Configuration/Connection.php');
                        
                        $sql = "SELECT * FROM recipes WHERE idRecipe=".$_GET['idRecipe'];
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc(); 
                        ?>
                        <h5 class="card-title">Detalles</h5>
                        <hr>
                        <form>
                            <h5>ID Receta</h5>
                            <input type="number" class="form-control" value="<?php echo $row['idRecipe'] ?>" disabled>
                            <hr>
                            <div class="form-group">
                                <label for="dateHour">Fecha de emisión</label>
                                <input type="text" class="form-control" id="dateHour" value="<?php echo $row['dateHour']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="routeAdministration">Vía de Administración</label>
                                <input type="text" class="form-control" id="routeAdministration" value="<?php echo $row['routeAdministration']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="duration">Duración por Dias</label>
                                <input type="text" class="form-control" id="duration" value="<?php echo $row['durationDays']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="duration">Duración por Meses</label>
                                <input type="text" class="form-control" id="duration" value="<?php echo $row['durationMonths']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="frequency">Frecuencia</label>
                                <input type="text" class="form-control" id="frequency" value="<?php echo $row['frequency']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="amount">Cantidad de empaque(s)</label>
                                <input type="text" class="form-control" id="amount" value="<?php echo $row['amount']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control" id="state" value="<?php echo $row['stateR']?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="specialInstructions">Instrucciones Especiales</label>
                                <input type="text" class="form-control" id="specialInstructions" value="<?php echo $row['specialInstructions']?>" disabled>
                            </div>
                            <br>
                            <?php 
                            // Corregir la consulta para obtener el nombre del medicamento
                            $idRecipe = $_GET['idRecipe'];

                            $sql = "SELECT m.nameM
                            FROM medicines m
                            INNER JOIN recipes r ON m.idMedicine = r.fkIdMedicine
                            WHERE r.idRecipe = $idRecipe";

                            $resultado = $conexion->query($sql);
                            $row_medicine = $resultado->fetch_assoc();
                            ?>
                            <div class="form-group">
                                <label for="medicine">Medicamento</label>
                                <input type="text" class="form-control" id="medicine" value="<?php echo $row_medicine['nameM']?>" disabled>
                            </div>
                            <br>
                            <?php 
                            // Corregir la consulta para obtener el ID del diagnóstico
                            $sql = "SELECT d.idDiagnosis
                            FROM diagnoses d
                            INNER JOIN recipes r ON d.idDiagnosis = r.fkIdDiagnosis
                            WHERE r.idRecipe = $idRecipe";

                            $resultado = $conexion->query($sql);
                            $row_diagnosis = $resultado->fetch_assoc();
                            ?>
                            <div class="form-group">
                                <label for="diagnosis">ID Diagnóstico</label>
                                <input type="number" class="form-control" id="diagnosis" value="<?php echo $row_diagnosis['idDiagnosis']?>" disabled>
                            </div>
                            <hr>
                            <a href="../PatientRecetas.php" type="button" class="btn btn-secondary">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz1qzWZ9UAX5p4Rp6MLPgaoJ6Ygo9iIYk5K5t+XKz7Ur" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-OnKx8xC7glK9BbYhKrC4pHnMZdfL8cb0UCI3Nj0ZXlEGvOnB44y2QLl9F/0p0W5p" crossorigin="anonymous"></script>
</body>

</html>
