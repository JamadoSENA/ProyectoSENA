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
    <link rel="shortcut icon" href="../../Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Paciente</title>
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
                            <span class="d-none d-sm-inline mx-1">Paciente</span>
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
                        Asignacion de Recetas
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tabla Recetas</h5>
                        <div class="table-responsive">
                            <table table id="tablaRecetas" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Via de Administracion</th>
                                        <th scope="col">Frecuencia</th>
                                        <th scope="col">Medicamento</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php /*
            
            require("../../../Configuration/Connection.php");
            
            $sql = $conexion->query("SELECT * from recipes");

            while ($resultado = $sql->fetch_assoc()){ */
            
            ?>
                                    <tr>
                                        <td scope="row" style="text-align: center;"></td>
                                        <td scope="row" style="text-align: center;"></td>
                                        <td scope="row" style="text-align: center;"></td>
                                        <td scope="row" style="text-align: center;"></td>
                                        <td scope="row" style="text-align: center;"></td>
                                        <td scope="row">
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
                                                <li><a href="Details/Receta.php?idRecipe=<?php echo $resultado['idRecipe']?>"
                                                        class="dropdown-item">Detalles</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <?php /*
                                } */
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Esta tabla muestra las recetas disponibles.
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
    new DataTable('#tablaRecetas', {
        layout: {
            topStart: {
                buttons: ['excel', 'pdf']
            }
        }
    });
    </script>
</body>

</html>