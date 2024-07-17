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

$marca_id = isset($_GET['marca_id']) ? $_GET['marca_id'] : '';
$sensor_id = isset($_GET['sensor_id']) ? $_GET['sensor_id'] : '';

$sql = "SELECT p.id, m.nombre as marca, s.nombre as sensor, s.precio, p.imagen_url
        FROM productos p
        JOIN marcas m ON p.marca_id = m.id
        JOIN sensores s ON p.sensor_id = s.id";

if ($marca_id) {
    $sql .= " AND p.marca_id = " . $marca_id;
}

if ($sensor_id) {
    $sql .= " AND p.sensor_id = " . $sensor_id;
}

$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($productos);
?>
