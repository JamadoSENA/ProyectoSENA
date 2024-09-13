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
    <title>Receta</title>
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
                    <h5 class="card-header">Asignacion de Receta</h5>
                    <div class="card-body">
                        <h5 class="card-title">Formulario</h5>
                        <?php 
                        
                        include ('../../../Configuration/Connection.php');
                        
                        $sql = "SELECT * FROM diagnoses WHERE idDiagnosis=".$_GET['idDiagnosis'];
                        $resultado = $conexion->query($sql);
                        $row = $resultado->fetch_assoc();
                        
                        ?>
                        <form class="needs-validation" method="post" action="../Forms/DiagnosticoReceta.php" novalidate>
                            <input type="hidden" class="form-control" name="fkIdDiagnosis"
                                value="<?php echo $row['idDiagnosis'] ?>">
                            <div class="form-group">
                                <label for="validationCustom01">Via de Administracion</label>
                                <select name="viaAdministracion" class="form-control" id="validationCustom01" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Vía sublingual y oral">Vía sublingual y oral</option>
                                    <option value="Vía rectal">Vía rectal</option>
                                    <option value="Vía ótica">Vía ótica</option>
                                    <option value="Vía nasal">Vía nasal</option>
                                    <option value="Vía transdérmica">Vía transdérmica</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecciona la via de administracion necesaria para el paciente.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom02">Duración por dias</label>
                                <input type="number" class="form-control" name="dias" id="validationCustom02" min=1
                                    max=31 required>
                                <div class="invalid-feedback">
                                    Por favor digita la cantidad de dias necesarias para el uso del medicamento, el
                                    valor maximo para ingresar es de 31 dias.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom03">Duración por meses (Si así lo requiere)</label>
                                <input type="number" class="form-control" name="meses" id="validationCustom03" min=0
                                    max=12>
                                <div class="invalid-feedback">
                                    El valor maximo para ingresar es de 12 meses.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom04">Frecuencia por horas</label>
                                <input type="number" class="form-control" name="horas" id="validationCustom04" min=1
                                    max=24 required>
                                <div class="invalid-feedback">
                                    Por favor digita la cantidad de horas para el consumo del medicamento, el
                                    valor maximo para ingresar es de 24 horas.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom05">Cantidad por empaque(s) / caja(s)</label>
                                <input type="number" class="form-control" name="cantidades" id="validationCustom05"
                                    min=1 max=10 required>
                                <div class="invalid-feedback">
                                    Por favor digita la cantidad de empaques para el consumo del medicamento, el
                                    valor maximo para ingresar es de 10 cantidades.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom06">Estado</label>
                                <select name="estado" class="form-control" id="validationCustom06" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="No retirado">No retirado</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecciona el estado del medicamento.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom07">Instrucciones Especiales</label>
                                <input type="text" class="form-control" name="instrucciones" id="validationCustom07"
                                    >
                                <div class="invalid-feedback">
                                    Por favor digita las instrucciones especiales para el consumo del medicamento.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="validationCustom08">Medicamento</label>
                                <select name="fkIdMedicine" class="form-control" id="patient" required>
                                    <option value="">Seleccionar</option>
                                    <?php 
        include ("../../../Configuration/Connection.php");

        // Consulta que filtra los medicamentos con stock mayor o igual a 1
        $sql = $conexion->query("SELECT idMedicine, nameM, stock FROM medicines WHERE stock >= 1 ORDER BY nameM ASC");
        while ($resultado = $sql->fetch_assoc()) {
            echo "<option value='".$resultado['idMedicine']."'>".$resultado['nameM']." - Disponible: ".$resultado['stock']."</option>";
        } 
        ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecciona un medicamento.
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="../DoctorRecetas.php" class="btn btn-secondary">Cancelar</a>
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