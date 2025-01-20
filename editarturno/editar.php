<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $horario_inicio = $_POST['horario_inicio'];
    $horario_fin = $_POST['horario_fin'];
    $sigla = $_POST['sigla'];

    $affected_rows = 0;

    // Iterar sobre los datos recibidos y actualizar cada fila
    for ($i = 0; $i < count($id); $i++) {
        $sql = "UPDATE turno SET Nombre=?, Apellido=?, Fecha=?, Estado=?, Horario_inicio=?, Horario_fin=?, Sigla=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $nombre[$i], $apellido[$i], $fecha[$i], $estado[$i], $horario_inicio[$i], $horario_fin[$i], $sigla[$i], $id[$i]);

        if ($stmt->execute()) {
            $affected_rows++;
        }
        $stmt->close();
    }

    // Redirigir a index.php con mensaje de éxito
    if ($affected_rows > 0) {
        header('Location: index.php?status=success');
    } else {
        header('Location: index.php?status=error');
    }
} else {
    header('Location: index.php'); // Redirigir si no se accede correctamente
}

$conn->close();
?>
