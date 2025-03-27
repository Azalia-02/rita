<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="encabezado">
        <a href="{{ route('login') }}">
            <img src="img/dinologin.jpg" alt="logo empresa" id="imgenbn">
        </a>
        <nav class="menu">
            <ul>
                <li><a href="contactanos.html">Contáctanos</a></li>
                <li><a href="{{ route('login') }}">Ingresa</a></li>
            </ul>
        </nav>
    </div>
    <br>
    <div id="cuerpo">
        <center>
            <form action="{{ route('login_registrar') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <h2>Regístrate</h2>
                
                <div class="form-floating mb-3">
                    <label for="floatingNombre">Ingresa tu nombre(s)</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" id="floatingNombre" placeholder="ejemplo: Azalia" aria-describedby="NombreHelp">
                    <div id="NombreHelp" class="form-text">
                        @if($errors->first('nombre')) <i>¡El campo Nombre(s) no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="floatingApp">Ingresa tu apellido(s)</label>
                    <input type="text" class="form-control" name="app" value="{{ old('app') }}" id="floatingApp" placeholder="ejemplo: Mejía" aria-describedby="ApellidoHelp">
                    <div id="AppHelp" class="form-text">
                        @if($errors->first('app')) <i>¡El campo Apellido(s) no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="floatingApm">Ingresa tu apellido(s)</label>
                    <input type="text" class="form-control" name="apm" value="{{ old('apm') }}" id="floatingApm" placeholder="ejemplo: Mejía" aria-describedby="ApellidoHelp">
                    <div id="ApmHelp" class="form-text">
                        @if($errors->first('apm')) <i>¡El campo Apellido(s) no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="floatingEmail">Ingresa tu correo</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="floatingEmail" placeholder="ejemplo: ejemplo@gmail.com" aria-describedby="EmailHelp">
                    <div id="EmailHelp" class="form-text">
                        @if($errors->first('email')) <i>¡El campo Correo no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="floatingPassword">Ingresa tu contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Ingresa tu contraseña">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="floatingPasswordConfirmation">Repite tu contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="floatingPasswordConfirmation" placeholder="Repite tu contraseña">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="rol">Selecciona el rol</label>
                    <select name="rol" class="form-control" id="rol">
                        <option value="user" {{ old('rol') == 'user' ? 'selected' : '' }}>Usuario</option>
                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    <div class="form-text">
                        @if($errors->first('rol')) <i>¡El campo rol no es correcto!</i> @endif
                    </div>
                </div>
                
                <hr><br>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-danger">Cancelar</button>
                </a>
            </form>
        </center>
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#floatingPassword');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>