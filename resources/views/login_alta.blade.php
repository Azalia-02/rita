<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
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
                <label for="floatingApellido">Ingresa tu apellido(s)</label>
                    <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" id="floatingApellido" placeholder="ejemplo: Mejía" aria-describedby="ApellidoHelp">
                    <div id="ApellidoHelp" class="form-text">
                        @if($errors->first('apellido')) <i>¡El campo Apellido(s) no es correcto!</i> @endif
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
                    <input type="password" class="form-control" name="password" id="floatingPassword">
                    <div id="PasswordHelp" class="form-text">
                        @if($errors->first('password')) <i>¡El campo contraseña no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                <label for="floatingRPassword">Repite tu contraseña</label>
                    <input type="password" class="form-control" name="rpassword" id="floatingRPassword">
                    <div id="RPasswordHelp" class="form-text">
                        @if($errors->first('rpassword')) <i>¡El campo de repetir contraseña no es correcto!</i> @endif
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="rol">Selecciona el rol</label>
                    <select name="rol" class="form-control" id="rol">
                    <option value="usuario" {{ old('rol') == 'usuario' ? 'selected' : '' }}>Usuario</option>
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

