<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="assets/styleRegistroTurno.css">
</head>

<body>

    <div class="container">

        <div class="logo-con-titulo">
            <img src="http://localhost/sistur/logo/logo.png" alt="Logo">
            <h2>Registro de Turnos</h2>
        </div>

        <nav class="menu-personalizado">
            <a href="http://localhost/sistur/Mantencion/mantencion.php">Volver al Menú</a>
        </nav>

        <form action="procesoregistro.php" method="post" class="cuadro-informacion form-grid">
            <div class="form-input">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-input">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-input">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>

            <div class="form-input">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="Día">Día</option>
                    <option value="Noche">Noche</option>
                    <option value="Libre">Libre</option>
                </select>
            </div>

            <div class="form-input">
                <label for="horarioInicio">Horario de Inicio:</label>
                <input type="time" id="horarioInicio" name="horarioInicio">
            </div>

            <div class="form-input">
                <label for="horarioFin">Horario de Fin:</label>
                <input type="time" id="horarioFin" name="horarioFin">
            </div>

            <div class="button-container">
                <input type="submit" value="Guardar Turno" class="button">
            </div>
        </form>

    </div>

</body>

</html>
