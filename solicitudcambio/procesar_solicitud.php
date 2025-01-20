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

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$motivo = $_POST['motivo'];
$correo = $_POST['correo'];

// Preparar y enlazar
$stmt = $conn->prepare("INSERT INTO solicitudes (nombre, apellido, motivo, correo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $apellido, $motivo, $correo);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: solicitudcambio.php?status=success");
} else {
    header("Location: solicitudcambio.php?status=error");
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
