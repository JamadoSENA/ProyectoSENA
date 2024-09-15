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
                        <li alt="Inicio">
                            <a href="../AdministratorIndex.php" class="nav-link px-0 text-white align-middle"
                                alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Usuarios">
                            <a href="../AdministratorUsuarios.php" class="nav-link px-0 text-white align-middle"
                                alt="Citas">
                                <i class="fs-4 bi-people-fill" alt="Usuarios"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Usuarios</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="../AdministratorRoles.php" class="nav-link px-0 text-white align-middle"
                                alt="Citas">
                                <i class="fs-4 bi-person-fill-gear" alt="Roles"></i> <span
                                    class="ms-1 d-none d-sm-inline">Roles</span> </a>
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
                    <h5 class="card-header">Actualización de Usuario</h5>
                    <div class="card-body">
                        <?php 
            include ('../../../Configuration/Connection.php');

            $sql = "SELECT * FROM users WHERE idUser=".$_GET['idUser'];
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
            ?>
                        <form class="needs-validation" method="post" action="../Forms/UsuarioUpdate.php" novalidate>
                            <!-- ID de usuario (oculto) -->
                            <label for=""># de Documento</label>
                            <input type="number" class="form-control" name="idUser" value="<?php echo $row['idUser'] ?>"
                                readonly>
                            <br>
                            <!-- Tipo de documento -->
                            <div class="form-group">
                                <label for="documentType">Tipo de documento</label>
                                <input type="text" class="form-control" id="documentType" name="documentType"
                                    value="<?php echo $row['documentType'] ?>" readonly>
                                <div class="invalid-feedback">
                                    Por favor ingrese el tipo de documento.
                                </div>
                            </div>
                            <br>

                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nameU">Nombre</label>
                                <input type="text" class="form-control" id="nameU" name="nameU"
                                    value="<?php echo $row['nameU'] ?>" readonly>
                                <div class="invalid-feedback">
                                    Por favor ingrese el nombre.
                                </div>
                            </div>
                            <br>

                            <!-- Apellido -->
                            <div class="form-group">
                                <label for="lastname">Apellido</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    value="<?php echo $row['lastname'] ?>" readonly>
                                <div class="invalid-feedback">
                                    Por favor ingrese el apellido.
                                </div>
                            </div>
                            <br>

                            <!-- Fecha de nacimiento -->
                            <div class="form-group">
                                <label for="birthdate">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate"
                                    value="<?php echo $row['birthdate'] ?>" readonly>
                                <div class="invalid-feedback">
                                    Por favor ingrese la fecha de nacimiento.
                                </div>
                            </div>
                            <br>

                            <!-- Edad -->
                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input type="number" class="form-control" id="age" name="age"
                                    value="<?php echo $row['age'] ?>" readonly>
                                <div class="invalid-feedback">
                                    Por favor ingrese la edad.
                                </div>
                            </div>
                            <br>

                            <!-- Género -->
                            <div class="form-group">
                                <label for="gender">Género</label>
                                <select class="form-control" id="gender" name="gender" readonly>
                                    <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione el género.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select class="form-control" id="role" name="role" readonly>
                                    <!-- Mostrar el rol seleccionado actualmente -->
                                    <option value="<?php echo $row['fkIdRole']; ?>">
                                        <?php 
                                        // Obtener el nombre del rol seleccionado
                                        $role_query = $conexion->query("SELECT name FROM roles WHERE idRole = " . $row['fkIdRole']);
                                        $role_result = $role_query->fetch_assoc();
                                        echo $role_result['name']; 
                                        ?>
                                    </option>

                                    <!-- Mostrar el resto de roles desde la base de datos -->
                                    <?php 
                                        $roles_query = $conexion->query("SELECT idRole, name FROM roles");
                                        while ($roles_row = $roles_query->fetch_assoc()) {
                                            if ($roles_row['idRole'] != $row['fkIdRole']) {
                                                echo "<option value='" . $roles_row['idRole'] . "'>" . $roles_row['name'] . "</option>";
                                            }
                                        }
                                        ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione el rol.
                                </div>
                            </div>
                            <br>
                            <a href="../AdministratorUsuarios.php" class="btn btn-secondary">Cancelar</a>
                        </form>

                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


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