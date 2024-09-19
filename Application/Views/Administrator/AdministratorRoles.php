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
    <title>Inicio</title>
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
                            <a href="AdministratorIndex.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-house-door-fill" alt="Inicio"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Inicio</span> </a>
                        </li>
                        <li alt="Usuarios">
                            <a href="AdministratorUsuarios.php" class="nav-link px-0 text-white align-middle"
                                alt="Citas">
                                <i class="fs-4 bi-people-fill" alt="Usuarios"></i> <span
                                    class="ms-1 d-none d-sm-inline">
                                    Usuarios</span> </a>
                        </li>
                        <li alt="Mis Citas">
                            <a href="AdministratorRoles.php" class="nav-link px-0 text-white align-middle" alt="Citas">
                                <i class="fs-4 bi-person-fill-gear" alt="Roles"></i> <span
                                    class="ms-1 d-none d-sm-inline">Roles</span> </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="mt-auto dropdown pb-4">
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
                        Gestion de Roles
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title" style="margin-top:8px">Tabla Roles</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="tablaRoles" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;"># de Rol</th>
                                        <th scope="col" style="text-align: center;">Nombre</th>
                                        <th scope="col" style="text-align: center;">Numeros de Usuarios</th>
                                        <th scope="col" style="text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Consulta para obtener el número de usuarios por rol
                                    $sql = $conexion->query("
                                    SELECT r.idRole, r.name, COUNT(u.idUser) AS num_usuarios 
                                    FROM roles r
                                    LEFT JOIN users u ON r.idRole = u.fkIdRole 
                                    GROUP BY r.idRole
                                    ");

                                    while ($resultado = $sql->fetch_assoc()){ 
                                    ?>

                                    <tr>
                                        <td scope="row" style="text-align: center;"><?php echo $resultado['idRole'] ?>
                                        </td>
                                        <td scope="row" style="text-align: center;"><?php echo $resultado['name'] ?>
                                        </td>
                                        <td scope="row" style="text-align: center;"><?php echo $resultado['num_usuarios'] ?>
                                        </td>
                                        <td scope="row" style="text-align: center;">
                                            <!-- Botón para abrir el modal -->
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#updateRoleModal"
                                                onclick="editRole(<?php echo $resultado['idRole']; ?>, '<?php echo $resultado['name']; ?>')">
                                                Actualizar
                                            </button>
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
                        Esta tabla muestra los usuarios existentes.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Actualizar Rol -->
    <div class="modal fade" id="updateRoleModal" tabindex="-1" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Actualizar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateRoleForm" action="Forms/RolUpdate.php" method="POST">
                        <input type="hidden" id="idRole" name="idRole">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Nombre del Rol</label>
                            <input type="text" class="form-control" id="roleName" name="roleName" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and other libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

    <!-- Script para DataTable -->
    <script type="text/javascript">
        new DataTable('#tablaRoles', {
            pageLength: 5
        });

        function editRole(id, name) {
            document.getElementById('idRole').value = id;
            document.getElementById('roleName').value = name;
        }
    </script>
</body>

</html>
