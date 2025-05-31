<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Turnos</title>
    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/stylecambio.css"> <!-- Enlace al archivo CSS personalizado -->
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <img src="http://localhost/sistur/logo/logo.png" alt="Logotipo" class="imagen-personalizada mb-3">
            <h1 class="display-4">Buscar Turno</h1>
        </div>
        <form method="POST" action="" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group col-md-12">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                <a href="http://localhost/sistur/Mantencion/mantencion.php" class="btn btn-secondary ml-2">Volver</a>
            </div>
        </form>
    </div>

        <?php
        include 'db.php';

        if (isset($_POST['buscar'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            $sql = "SELECT * FROM turno WHERE Nombre LIKE '%$nombre%' AND Apellido LIKE '%$apellido%'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo '<form method="POST" action="editar.php">';
                echo '<div class="table-container">';
                echo '<table class="table table-striped table-dark table-bordered mt-4">';
                echo '<thead><tr><th>Nombre</th><th>Apellido</th><th>Fecha</th><th>Estado</th><th>Horario Inicio</th><th>Horario Fin</th><th>Sigla</th></tr></thead>';
                echo '<tbody>';

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><input type="text" name="nombre[]" value="' . $row['Nombre'] . '" class="form-control"></td>';
                    echo '<td><input type="text" name="apellido[]" value="' . $row['Apellido'] . '" class="form-control"></td>';
                    echo '<td><input type="date" name="fecha[]" value="' . $row['Fecha'] . '" class="form-control"></td>';
                    echo '<td><input type="text" name="estado[]" value="' . $row['Estado'] . '" class="form-control"></td>';
                    echo '<td><input type="time" name="horario_inicio[]" value="' . $row['Horario_inicio'] . '" class="form-control"></td>';
                    echo '<td><input type="time" name="horario_fin[]" value="' . $row['Horario_fin'] . '" class="form-control"></td>';
                    echo '<td><input type="text" name="sigla[]" value="' . $row['Sigla'] . '" class="form-control"></td>';
                    echo '<input type="hidden" name="id[]" value="' . $row['ID'] . '">';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '<td><button type="submit" class="btn btn-success" name="editar">Editar/Guardar</button></td>';
                echo '</div>';
                echo '</form>';
            } else {
                echo '<div class="alert alert-warning mt-4" role="alert">No se encontraron resultados.</div>';
            }
        }

        $conn->close();
        ?>
    </div>

    <!-- PHP para mostrar alertas -->
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'success') {
            echo '<div class="alert alert-success show fade-out" role="alert">Cambios guardados exitosamente.</div>';
        } elseif ($_GET['status'] === 'error') {
            echo '<div class="alert alert-danger show fade-out" role="alert">Error al guardar los cambios. Inténtelo de nuevo.</div>';
        }
    }
    ?>
</body>
</html>
