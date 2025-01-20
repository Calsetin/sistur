<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Solicitudes</title>
    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styleestadosoli.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <div class="container mt-4">
        <div class="logo-con-titulo">
            <img src="http://localhost/sistur/logo/logo.png" alt="Logotipo" class="imagen-personalizada">
            <h1>Estado de Solicitudes</h1>
        </div>
        <form action="" method="post" class="mb-4 form-inline justify-content-center">
            <div class="form-group mx-sm-3 mb-2">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" placeholder="" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="nombre">Apellido:</label>
                <input type="text" name="apellido" class="form-control" placeholder="" required>
            </div>
            <button type="submit" name="buscar" class="btn btn-primary mb-2">Buscar</button>
            <a href="http://localhost/sistur/solicitudes/solicitudes.php" class="btn btn-secondary mb-2 ml-2">Volver</a>
        </form>
        
        <?php
        $mostrarTabla = false;
        if (isset($_POST['buscar'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'validar');

            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            // Consulta para obtener las solicitudes por nombre y apellido
            $sql = "SELECT * FROM solicitudes WHERE nombre = ? AND apellido = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $nombre, $apellido);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $mostrarTabla = true;
                echo '<table class="table table-striped table-dark mt-4">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Nombre</th>';
                echo '<th>Apellido</th>';
                echo '<th>Motivo</th>';
                echo '<th>Fecha</th>';
                echo '<th>Correo</th>';
                echo '<th>Respuesta</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<tr>' .
                        '<td>' . $fila['nombre'] . '</td>' .
                        '<td>' . $fila['apellido'] . '</td>' .
                        '<td>' . $fila['motivo'] . '</td>' .
                        '<td>' . $fila['fecha'] . '</td>' .
                        '<td>' . $fila['correo'] . '</td>' .
                        '<td>' . ($fila['respuesta'] ? $fila['respuesta'] : 'En espera de Aprobacion') . '</td>' .
                        '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p class="text-center mt-4">No se encontraron solicitudes</p>';
            }

            // Cerrar la conexión a la base de datos
            $stmt->close();
            $conexion->close();
        }
        ?>
    </div>
</body>
</html>
