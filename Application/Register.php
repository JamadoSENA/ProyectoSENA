<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="Resources/IMG/LogoHeadMediStock.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row">
            <div class="card mb-4 mx-auto" style="max-width: 850px;">
                <div class="row g-0 justify-content-center align-items-center">
                    <div class="col-md-4">
                        <img src="Resources/IMG/IMG-Register.jpg" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Información de Usuario</h5>
                            <hr>
                            <form class="row g-3 needs-validation" method="post"
                                action="../Configuration/RegisterUser.php" novalidate>
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">No. Documento</label>
                                    <input type="number" name="Cedula" id="document" class="form-control input-lg"
                                        tabindex="1" required />
                                    <div class="invalid-feedback">
                                        Por favor, digite su numero de documento.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Tipo de Documento</label>
                                    <select class="form-select" name="TipoDocumento" required>
                                        <option value="">Elegir...</option>
                                        <option value="CC">Cedula Ciudadania</option>
                                        <option value="CE">Cedula Extranjeria</option>
                                        <option value="TI">Tartjeta Identidad</option>
                                        <option value="NUIP">
                                            Numero Unico de Identificacion Personal
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, seleccione el tipo de su documento.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Primer Nombre</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="Nombre"
                                        required>
                                    <div class="invalid-feedback">
                                        Por favor, digite su primer nombre.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Primer Apellido</label>
                                    <input type="text" class="form-control" id="validationCustom02" name="Apellido"
                                        required>
                                    <div class="invalid-feedback">
                                        Por favor, digite su primer apellido.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustomUsername" class="form-label">Fecha de Nacimiento</label>
                                    <div class="input-group has-validation">
                                        <input type="date" name="FechaNacimiento" id="birthdate"
                                            class="form-control input-lg" placeholder="Fecha de Nacimiento" tabindex="5"
                                            required />
                                        <div class="invalid-feedback">
                                            Por favor, digite correctamente su fecha de nacimiento.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom03" class="form-label">Edad</label>
                                    <input name="Edad" type="number" class="form-control" id="age" readonly tabindex="6"
                                        required />
                                </div>
                                <script>
                                const inputFechaNacimiento = document.getElementById("birthdate");
                                const inputEdad = document.getElementById("age");

                                inputFechaNacimiento.addEventListener("input", function() {
                                    const fechaNacimiento = new Date(this.value);
                                    const fechaActual = new Date();

                                    if (isNaN(fechaNacimiento.getTime())) {
                                        // La fecha ingresada no es válida
                                        this.setCustomValidity("Se requiere una fecha válida.");
                                        this.parentElement.classList.add("was-validated");
                                    } else if (fechaNacimiento > fechaActual) {
                                        // La fecha ingresada es en el futuro
                                        this.setCustomValidity(
                                            "La fecha de nacimiento no puede ser en el futuro."
                                        );
                                        this.parentElement.classList.add("was-validated");
                                    } else {
                                        // La fecha ingresada es válida
                                        this.setCustomValidity("");
                                        this.parentElement.classList.remove("was-validated");

                                        // Calcular edad
                                        const diff = fechaActual - fechaNacimiento;
                                        const edad = Math.floor(
                                            diff / (1000 * 60 * 60 * 24 * 365.25)
                                        );
                                        inputEdad.value = edad;
                                    }
                                });

                                inputEdad.addEventListener("input", function() {
                                    const edad = parseInt(this.value);
                                    const fechaNacimiento = new Date(inputFechaNacimiento.value);
                                    const fechaLimite = new Date(fechaNacimiento);
                                    fechaLimite.setFullYear(fechaNacimiento.getFullYear() + edad);

                                    const fechaActual = new Date();

                                    if (isNaN(edad) || edad < 0) {
                                        // La edad ingresada no es válida
                                        this.setCustomValidity("Se requiere una edad válida.");
                                        this.parentElement.classList.add("was-validated");
                                    } else if (fechaLimite > fechaActual) {
                                        // La edad ingresada resulta en una fecha de nacimiento en el futuro
                                        this.setCustomValidity(
                                            "La fecha de nacimiento resultante con esta edad sería en el futuro."
                                        );
                                        this.parentElement.classList.add("was-validated");
                                    } else {
                                        // La edad ingresada es válida
                                        this.setCustomValidity("");
                                        this.parentElement.classList.remove("was-validated");
                                    }
                                });
                                </script>
                                <div class="col-md-4">
                                    <label for="validationCustom04" class="form-label">Genero</label>
                                    <select class="form-select" name="Genero" required>
                                        <option value="">Elegir...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, seleccione al genero al que pertenece.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom05" class="form-label">No. Telefonico</label>
                                    <input type="number" name="Telefono" id="phone_number" class="form-control" min="0"
                                        max="3999999999" required />
                                    <div class="invalid-feedback">
                                        Por favor, digite su numero telefónico.
                                    </div>
                                </div>
                                <script>
                                document.getElementById('phone_number').addEventListener('input', function() {
                                    const phoneNumber = this.value;
                                    const feedback = document.getElementById('phone_feedback');

                                    if (phoneNumber.length > 0 && phoneNumber.charAt(0) !== '3') {
                                        this.setCustomValidity(
                                            'Número telefónico inválido. Debe comenzar con 3.');
                                        feedback.style.display = 'block';
                                    } else {
                                        this.setCustomValidity('');
                                        feedback.style.display = 'none';
                                    }
                                });
                                </script>
                                <div class="col-md-4">
                                    <label for="validationCustom05" class="form-label">Profesion</label>
                                    <input type="text" name="Profesion" id="profession" class="form-control" required />
                                    <div class="invalid-feedback">
                                        Por favor, digite su profesion.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom05" class="form-label">Direccion</label>
                                    <input type="text" name="Direccion" id="address" class="form-control" required />
                                    <div class="invalid-feedback">
                                        Por favor, digite su profesion.
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="validationCustomUsername" class="form-label">Correo Electrónico</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" name="Correo" class="form-control"
                                            id="validationCustomUsername" aria-describedby="inputGroupPrepend"
                                            placeholder="name@example.com" required>
                                        <div class="invalid-feedback">
                                            Por favor, digite su correo electronico.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" id="password" class="form-control" required />
                                    <span id="toggle-password" class="position-absolute toggle-password"
                                        style="top: 38px; right: 20px; cursor: pointer;">
                                        <i class="bi bi-eye-slash" id="icono-ojito1"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Por favor, digite su contraseña.
                                    </div>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" name="Contrasenia" id="confirm-password" class="form-control"
                                        required />
                                    <span id="toggle-confirm-password" class="position-absolute toggle-password"
                                        style="top: 38px; right: 20px; cursor: pointer;">
                                        <i class="bi bi-eye-slash" id="icono-ojito2"></i>
                                    </span>
                                    <div class="invalid-feedback">
                                        Por favor, digite la confirmación de su contraseña.
                                    </div>
                                </div>
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const password = document.getElementById('password');
                                    const confirmPassword = document.getElementById('confirm-password');
                                    const togglePassword1 = document.getElementById('toggle-password');
                                    const togglePassword2 = document.getElementById('toggle-confirm-password');
                                    const iconoOjito1 = document.getElementById('icono-ojito1');
                                    const iconoOjito2 = document.getElementById('icono-ojito2');
                                    const form = password.closest('form');

                                    function toggleVisibility(input, icon) {
                                        if (input.type === 'password') {
                                            input.type = 'text';
                                            icon.classList.remove('bi-eye-slash');
                                            icon.classList.add('bi-eye');
                                        } else {
                                            input.type = 'password';
                                            icon.classList.remove('bi-eye');
                                            icon.classList.add('bi-eye-slash');
                                        }
                                    }

                                    togglePassword1.addEventListener('click', function() {
                                        toggleVisibility(password, iconoOjito1);
                                    });

                                    togglePassword2.addEventListener('click', function() {
                                        toggleVisibility(confirmPassword, iconoOjito2);
                                    });

                                    form.addEventListener('submit', function(event) {
                                        if (password.value !== confirmPassword.value) {
                                            event.preventDefault();
                                            confirmPassword.setCustomValidity(
                                                'Las contraseñas no coinciden.');
                                            confirmPassword.reportValidity();
                                        } else {
                                            confirmPassword.setCustomValidity('');
                                        }
                                    });

                                    confirmPassword.addEventListener('input', function() {
                                        if (password.value === confirmPassword.value) {
                                            confirmPassword.setCustomValidity('');
                                        } else {
                                            confirmPassword.setCustomValidity(
                                                'Las contraseñas no coinciden.');
                                        }
                                    });
                                });
                                </script>
                                <div class="col-md-6 position-relative">
                                    <label for="form-label">Registrarme como:</label>
                                    <select class="form-select" name="Rol" required>
                                        <option value="">Elegir...</option>
                                        <option value="1">Paciente</option>
                                        <option value="2">Doctor</option>
                                        <option value="3">Inventarista</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, digite la confirmación de su contraseña.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Acepto terminos y condiciones.
                                        </label>
                                        <div class="invalid-feedback">
                                            Debes estar de acuerdo antes de registrarse.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success" type="submit">Registrarme</button>
                                    <a href="LogIn.php" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-footer">
                        <small class="text-body">MediStock © 2024. Todos los derechos reservados.</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>