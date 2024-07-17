<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gps_connect";
$puerto = 3306;


$conn = new mysqli($servername, $username, $password, $dbname, $puerto);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$marcas_sql = "SELECT id, nombre FROM marcas";
$marcas_result = $conn->query($marcas_sql);

$sensores_sql = "SELECT id, nombre, precio FROM sensores";
$sensores_result = $conn->query($sensores_sql);

$marcas = [];
$sensores = [];

if ($marcas_result->num_rows > 0) {
    while ($row = $marcas_result->fetch_assoc()) {
        $marcas[] = $row;
    }
}

if ($sensores_result->num_rows > 0) {
    while ($row = $sensores_result->fetch_assoc()) {
        $sensores[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(['marcas' => $marcas, 'sensores' => $sensores]);
?>
