<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $USUARIO = $_POST['usuario'];
    $PASSWORD = $_POST['password'];

    // Sanitizar los datos de entrada (evitar inyección SQL)
    $USUARIO = mysqli_real_escape_string($conexion, $USUARIO);
    $PASSWORD = mysqli_real_escape_string($conexion, $PASSWORD);

    $consulta = "SELECT * FROM Personal WHERE usuario = '$USUARIO' AND password ='$PASSWORD'";
    $resultado = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($resultado);

    if ($filas) {
        // Iniciar sesión y redirigir si las credenciales son correctas
        session_start();
        $_SESSION['usuario'] = $USUARIO;
        header("location: http://localhost/sistur/Mantencion/mantencion.php");
        exit();
    } else {
        // Mostrar mensaje de error y redirigir a la página de inicio de sesión
        header("Refresh: 1; url=http://localhost/sistur/Login/inicioSesion.php"); // Redirigir a iniciosesion.php después de 5 segundos
        ?>
        <p class="error-message">ERROR DE AUTENTICACIÓN</p>
        <?php
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
}
?>