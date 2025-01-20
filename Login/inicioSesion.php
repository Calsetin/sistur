<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styleiniSesion.css">
    <title>SISTUR</title>
</head>
<body>
    <form action="" method="post">
        <img src="http://localhost/sistur/logo/logo.png" alt="logosename" class="logo">
        <h3>Bienvenido</h3>
        <?php
        include("login.php");
        include("db.php")
        ?>
        <label for="usuario">Nombre de usuario</label>
        <input type="text" placeholder="Ingrese su Usuario" name="usuario"> 
        <label for="password">Contraseña</label>
        <input type="password" placeholder="ingrese su Contraseña" name="password">
        <button type="submit" value="iniciar sesion" name="iniciar">
            Iniciar Sesión <!-- Quita el enlace 'a' dentro del botón -->
        </button>

        <a href="http://localhost/sistur/principal.html" class="boton-volver">Volver</a>

    </form>
</body>
</html>
