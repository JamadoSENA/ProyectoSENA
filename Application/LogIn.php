<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="shortcut icon" href="Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}

.h-custom {
    height: calc(100% - 73px);
}

@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }
}
</style>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="Resources/IMG/LogoColorVerde.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="../Configuration/Functions.php" method="POST">
                        <h1>Iniciar Sesion</h1>
                        <div class="divider d-flex align-items-center my-4">
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Correo Electronico</label>
                            <input type="email" id="form3Example3" class="form-control form-control-lg" name="correo"
                                required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Contraseña</label>
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                name="contrasenia" required />
                            <input type="hidden" name="accion" value="acceso_user">
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-success btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Iniciar Sesion</button>
                            <a type="button" href="Register.php" class="btn btn-secondary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrarse</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-secondary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                MediStock © 2024. Todos los derechos reservados.
            </div>
            <!-- Copyright -->
        </div>
    </section>
</body>

</html>