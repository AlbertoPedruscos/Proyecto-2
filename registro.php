<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="./css/style3.css">
    <link rel="stylesheet" href="./css/error.css">
</head>
<body>
<section>
        <div class="contenedor2">
            <div class="formulario">
                <div class="logo2">
                    <img src="./images/logo.png" alt="">
                </div>
                <!-- Div del Formulario -->
                <div class="form2">
                    <form action="./php/registrar.php" method="post" onsubmit="return validaFormulario()">
                        <!-- Div login usuario -->
                        <div class="input-contenedor">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="user" id="user" placeholder="Usuario" oninput="limitarLongitud(this, 20)">
                        </div>

                        <div class="input-contenedor">
                            <i class="fa-solid fa-lock"></i>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" oninput="limitarLongitud(this, 60)">
                        </div>
                        <div class="input-contenedor">
                            <i class="fa-solid fa-lock"></i>
                            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" oninput="limitarLongitud(this, 9)">
                        </div>
                        <!-- Div login contraseña -->
                        <div class="input-contenedor">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="pwd" id="pwd" placeholder="Contraseña" oninput="limitarLongitud(this, 15)">
                        </div>
                        <!-- Mensaje de error -->
                        <label for="" id="error" class="errorlogin"></label>
                        <br>
                        <br>
                        <!-- Boton iniciar sesión -->
                        <button type="submit" name="registro" value="registro">Registrarse</button>
                    </form>
                    <br>
                    <a href="index.php"><button type="button">Iniciar Sesión</button></a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script src="./js/validaciones.js"></script>