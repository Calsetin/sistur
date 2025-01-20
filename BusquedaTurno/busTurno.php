<?php
include('db.php');

$result = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre']) && empty($_POST['apellido'])) {
        $nombre = $_POST['nombre'];
        
        $sql = "SELECT * FROM turno WHERE LOWER(Nombre) LIKE LOWER(?)";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            $paramNombre = "%$nombre%";
            mysqli_stmt_bind_param($stmt, "s", $paramNombre);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    } elseif (empty($_POST['nombre']) && isset($_POST['apellido'])) {
        $apellido = $_POST['apellido'];
        
        $sql = "SELECT * FROM turno WHERE LOWER(Apellido) LIKE LOWER(?)";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            $paramApellido = "%$apellido%";
            mysqli_stmt_bind_param($stmt, "s", $paramApellido);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    } elseif (isset($_POST['nombre'], $_POST['apellido'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $sql = "SELECT * FROM turno WHERE LOWER(Nombre) LIKE LOWER(?) AND LOWER(Apellido) LIKE LOWER(?)";
        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            $paramNombre = "%$nombre%";
            $paramApellido = "%$apellido%";
            mysqli_stmt_bind_param($stmt, "ss", $paramNombre, $paramApellido);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    }
}    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="assets/stylebusTurno.css">
    <title>SISTUR</title>
</head>
<body>
    <div class="logo-con-titulo">
        <img src="http://localhost/sistur/logo/logo.png" alt="logo" class="imagen-personalizada">
        <h1>Horarios Asignados</h1>
    </div>

    <form action="" method="post">
        <div class="form-input">
            <label for="nombre">NOMBRE:</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div class="form-input">
            <label for="apellido">APELLIDO:</label>
            <input type="text" id="apellido" name="apellido">
        </div>
        <input type="submit" value="Buscar" class="button">
    </form>

    <nav class="menu-personalizado">
        <a href="http://localhost/sistur/principal.html">Volver al Menú</a>
    </nav>

    <div>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            $mostrar = mysqli_fetch_array($result);
            echo "<div class='nombre-apellido'>";
            echo "<h3>{$mostrar['Nombre']} {$mostrar['Apellido']}</h3>";
            echo "</div>";
            // No muestra más información ya que solo deseas el nombre y apellido de la primera persona encontrada
        }
        ?>
        </div>

    <div class="tabla-personalizada">
    <table class="table table-dark table-striped">
    <tbody>
         <?php
         if ($result && mysqli_num_rows($result) > 0) {
            ?>
            <div class="tabla-personalizada">
                <table class="table table-dark table-striped">
                    <tbody>
                        <tr>
                            <th scope='row'>Fecha</th>
                            <th scope='row'>Estado</th>
                            <th scope='row'>Sigla</th>
                            <th scope='row'>Horario Inicio</th>
                            <th scope='row'>Horario Fin</th>
                        </tr>
                        <?php
                        mysqli_data_seek($result, 0); // Reiniciar el puntero a la primera fila
                        while ($mostrar = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $mostrar['Fecha'] . "</td>";
                            echo "<td>" . $mostrar['Estado'] . "</td>";
                            echo "<td>" . $mostrar['Sigla'] . "</td>";
                            echo "<td>" . $mostrar['Horario_inicio'] . "</td>";
                            echo "<td>" . $mostrar['Horario_fin'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                } elseif ($result) {
                    echo '<div class="contenedor-mensaje">';
                    echo '<p class="mensaje">No hay resultados</p>';
                    echo '</div>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>