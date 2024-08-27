<?php
/*
    session_start();
    error_reporting(0);

    $validar = $_SESSION['correo'];

    if( $validar == null || $validar = ''){

    header("Location: ../../../LogIn.php");
    die();
    
    }

*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Receta</title>
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
                            <span class="d-none d-sm-inline mx-1">Doctor</span>
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
                    <h5 class="card-header">Informacion de Receta</h5>
                    <div class="card-body">
                        <?php /*
                        
                        include ('../../../../Configuration/Connection.php');
                        
                        $sql = "SELECT * FROM recipes WHERE idRecipe=".$_GET['idRecipe'];
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        */
                        ?>
                        <h5 class="card-title">Detalles</h5>
                        <form>
                            <h5>ID Receta</h5>
                            <input type="number" class="form-control" value="<?php /*echo $row['idRecipe']*/ ?>"
                                disabled>
                            <hr>
                            <div class="form-group">
                                <label for="dateHour">Fecha de emision</label>
                                <input type="text" class="form-control" id="dateHour"
                                    value="<?php /*echo $row['dateHour']*/ ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="routeAdministration">Via de Administracion</label>
                                <input type="text" class="form-control" id="routeAdministration"
                                    value="<?php /*echo $row['routeAdministration']*/ ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="durationDay">Duracion en dias</label>
                                <input type="text" class="form-control" id="durationDay"
                                    value="<?php /*echo $row['durationDay']*/ ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="durationMonth">Duracion en meses</label>
                                <input type="text" class="form-control" id="durationMonth"
                                    value="<?php /*echo $row['durationMonth']*/ ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="frequency">Frecuencia en horas</label>
                                <input type="text" class="form-control" id="frequency"
                                    value="<?php /*echo $row['frequency']*/ ?>" disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="amount">Cantidad de empaque(s)</label>
                                <input type="text" class="form-control" id="amount" value="<?php /*echo $row['amount']*/ ?>"
                                    disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="stateR">Estado</label>
                                <input type="text" class="form-control" id="stateR" value="<?php /*echo $row['stateR']*/ ?>"
                                    disabled>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="specialInstructions">Instrucciones Especiales</label>
                                <input type="text" class="form-control" id="specialInstructions"
                                    value="<?php /*echo $row['specialInstructions']*/ ?>" disabled>
                            </div>
                            <br>
                            <?php /*
                            require("../../../../Configuration/Connection.php");

                            $idRecipe = $_GET['idRecipe'];

                            $sql = "SELECT m.idMedicine
                            FROM medicines m
                            INNER JOIN recipes r ON m.idMedicine = r.fkIdMedicine
                            WHERE r.idRecipe = $idRecipe";

                            $resultado = $conexion->query($sql);

                            if ($resultado->num_rows > 0) {
                            $row = $resultado->fetch_assoc();
                            $nameM = $row['nameM'];
                            }
                            */
                            ?>
                            <div class="form-group">
                                <label for="medicine">Medicamento</label>
                                <input type="text" class="form-control" id="medicine" value="<?php /*echo $row['nameM']*/ ?>"
                                    disabled>
                            </div>
                            <br>
                            <?php /*
                            require("../../../../Configuration/Connection.php");

                            $idRecipe = $_GET['idRecipe'];

                            $sql = "SELECT d.idDiagnosis
                            FROM diagnosis d
                            INNER JOIN recipes r ON d.idDiagnosis = r.fkIdDiagnosis
                            WHERE r.idRecipe = $idRecipe";

                            $resultado = $conexion->query($sql);

                            if ($resultado->num_rows > 0) {
                            $row = $resultado->fetch_assoc();
                            $idDiagnosis = $row['idDiagnosis'];
                            }
                            */
                            ?>
                            <div class="form-group">
                                <label for="diagnosis">ID Diagnostico</label>
                                <input type="number" class="form-control" id="diagnosis"
                                    value="<?php /*echo $row['idDiagnosis']*/?>" disabled>
                            </div>
                            <hr>
                            <a href="../DoctorRecetas.php" type="button" class="btn btn-secondary">Regresar</a>
                        </form>
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