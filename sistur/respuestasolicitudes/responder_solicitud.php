<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "validar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_solicitud = $_POST['id_solicitud'];
$respuesta = $_POST['respuesta'];

// Verificar si los valores se han recibido correctamente
if (empty($id_solicitud) || empty($respuesta)) {
    header("Location: visualizar_solicitudes.php?status=error");
    exit;
}

// Actualizar la solicitud con la respuesta
$stmt = $conn->prepare("UPDATE solicitudes SET respuesta = ? WHERE id = ?");
$stmt->bind_param("si", $respuesta, $id_solicitud);

// Ejecutar la consulta
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: visualizar_solicitudes.php?status=success");
    exit;
} else {
    $stmt->close();
    $conn->close();
    header("Location: visualizar_solicitudes.php?status=error");
    exit;
}
?>
