<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar y Responder Solicitudes</title>
    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/stylecambio.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <div class="container mt-4">
        <div class="logo-con-titulo">
            <img src="http://localhost/sistur/logo/logo.png" alt="Logotipo" class="imagen-personalizada">
            <h1>Lista de Solicitudes</h1>
        </div>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Correo</th>
                    <th>Responder</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se generarán dinámicamente las filas de la tabla con PHP -->
                <?php
                // Conexión a la base de datos
                $conexion = new mysqli('localhost', 'root', '', 'validar');

                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }

                // Consulta para obtener todas las solicitudes no respondidas
                $sql = "SELECT * FROM solicitudes WHERE respuesta IS NULL OR respuesta = ''";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<tr>' .
                            '<td>' . $fila['nombre'] . '</td>' .
                            '<td>' . $fila['apellido'] . '</td>' .
                            '<td>' . $fila['motivo'] . '</td>' .
                            '<td>' . $fila['fecha'] . '</td>' .
                            '<td>' . $fila['correo'] . '</td>' .
                            '<td>' .
                            '<form action="responder_solicitud.php" method="post">' .
                            '<input type="hidden" name="id_solicitud" value="' . $fila['id'] . '">' .
                            '<textarea class="form-control mb-2" name="respuesta" rows="3" placeholder="Escribe tu respuesta..." required></textarea>' .
                            '<button type="submit" class="btn btn-primary">Enviar respuesta</button>' .
                            '</form>' .
                            '</td>' .
                            '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No hay solicitudes</td></tr>';
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();
                ?>
            </tbody>
        </table>
        <a href="http://localhost/sistur/Mantencion/mantencion.php" class="btn btn-secondary">Volver</a>
    </div>

    <!-- PHP para mostrar alertas -->
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'success') {
            echo '<div class="alert alert-success show fade-out" role="alert">Solicitud respondida correctamente.</div>';
        } elseif ($_GET['status'] === 'error') {
            echo '<div class="alert alert-danger show fade-out" role="alert">Hubo un problema al responder la solicitud. Inténtelo de nuevo.</div>';
        }
    }
    ?>

    <!-- jQuery y otros scripts opcionales pueden ir aquí si es necesario -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
