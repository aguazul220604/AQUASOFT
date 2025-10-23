<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Heredad</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles3.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    @if (session('message') === 'error')
        <script>
            Swal.fire({
                text: "Datos incorrectos",
                icon: "warning",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 shadow-lg rounded overflow-hidden login-container">
            <div class="d-flex flex-column-reverse flex-lg-row w-100">
                <div class="col-12 col-lg-6 p-0">
                    <div class="h-100 w-100 bg-image"
                        style="background-image: url('{{ asset('images/img28wp.jpg') }}'); background-size: cover; background-position: center; min-height: 200px;">
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-4 d-flex flex-column justify-content-center">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/img2wp.png') }}" alt="Logo Balneario" class="img-fluid"
                            style="max-height: 100px;">
                        <h3>Centro Ecoturístico La Heredad</h3>
                        <h5>Iniciar sesión</h5>
                    </div>
                    <form method="POST" action="{{ route('usuarios.loginUser') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Contraseña" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                        <script>
                            document.getElementById('togglePassword').addEventListener('click', function() {
                                const passwordInput = document.getElementById('password');
                                const toggleIcon = document.getElementById('toggleIcon');
                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    toggleIcon.classList.remove('bi-eye-slash');
                                    toggleIcon.classList.add('bi-eye');
                                } else {
                                    passwordInput.type = 'password';
                                    toggleIcon.classList.remove('bi-eye');
                                    toggleIcon.classList.add('bi-eye-slash');
                                }
                            });
                        </script>
                        <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <BR></BR>
</body>

</html>
