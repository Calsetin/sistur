<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "validar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];
$horarioInicio = null;
$horarioFin = null;

// Definir la secuencia deseada de tipos de turno
$secuenciaTurnos = ["Día", "Día", "Noche", "Noche", "Libre", "Libre"];

// Encontrar el índice del primer turno
$primerTurno = array_search($estado, $secuenciaTurnos);

// Rotar la secuencia de turnos para iniciar con el tipo de turno seleccionado
$secuenciaTurnos = array_merge(array_slice($secuenciaTurnos, $primerTurno), array_slice($secuenciaTurnos, 0, $primerTurno));

// Inicializar contadores de correlativos
$correlativoDia = 1;
$correlativoNoche = 1;
$correlativoLibre = 1;

// Generar automáticamente los turnos restantes del mes
$fechaActual = new DateTime($fecha);
$ultimoDiaMes = $fechaActual->format('t');

for ($i = 0; $i < $ultimoDiaMes; $i++) {
    // Determinar el tipo de turno según la secuencia
    $tipoTurno = $secuenciaTurnos[$i % count($secuenciaTurnos)];

    // Determinar la sigla
    if ($tipoTurno == "Día") {
        $sigla = "D" . $correlativoDia++;
    } elseif ($tipoTurno == "Noche") {
        $sigla = "N" . $correlativoNoche++;
    } else {
        // Turno "Libre" sigue el patrón "L1", "L2", etc.
        $sigla = "L" . $correlativoLibre++;
    }

    // Reiniciar correlativo de "Libre" al llegar a 2
    if ($tipoTurno == "Libre" && $correlativoLibre > 2) {
        $correlativoLibre = 1;
    }

    // Reiniciar correlativos al cambiar de turno "Libre"
    if ($tipoTurno == "Libre") {
        $correlativoDia = 1;
        $correlativoNoche = 1;
    }

    // Asignar horarios automáticos si no es "Libre"
    if ($tipoTurno == "Día") {
        $horarioInicio = "09:00";
        $horarioFin = "21:00";
    } elseif ($tipoTurno == "Noche") {
        $horarioInicio = "21:00";
        $horarioFin = "09:00";
    } else {
        // Turno "Libre" sin horario
        $horarioInicio = null;
        $horarioFin = null;
    }

    // Insertar el turno en la base de datos
    $sql = "INSERT INTO turno (Nombre, Apellido, Fecha, Estado, Horario_inicio, Horario_fin, Sigla) VALUES ('$nombre', '$apellido', '" . $fechaActual->format('Y-m-d') . "', '$tipoTurno', '$horarioInicio', '$horarioFin', '$sigla')";
    $conn->query($sql);

    $fechaActual->add(new DateInterval('P1D'));
}

// Redirigir a la página principal o mostrar un mensaje de éxito
header("Location: sistematurno.php");
exit();

// Cerrar la conexión
$conn->close();
?>