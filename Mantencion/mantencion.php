<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styleMantencion.css">
    <title>SISTUR</title>
</head>
<body>
    <div class="container">
        <img src="http://localhost/sistur/logo/logo.png" alt="logosename">
        <h1 class="titulo">Bienvenido ¿Que desea hacer?</h1>
        <div class="buttons">
            <form action="http://localhost/sistur/RegistroTurno/sistematurno.php">
                <button>Registro de Turnos</button>
            </form>
            <form action="http://localhost/sistur/editarturno/">
                <button>Editar Turnos</button>
            </form>
            <form action="http://localhost/sistur/respuestasolicitudes/visualizar_solicitudes.php">
                <button>Revisar Solicidudes</button>
            </form>
        </div>
        <a href="http://localhost/sistur/Login/logout.php" class="cerrar-sesion">Cerrar Sesion</a>
    </div>
</body>
</html>