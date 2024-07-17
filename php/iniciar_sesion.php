<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gps_connect";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$error_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT username, password FROM usuarios WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
     
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        
        if ($password == $stored_password) {
            $_SESSION['username'] = $username;
            header('Location: ../index.html#somos-proya');
            exit();
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
         $error_message = "Nombre de usuario incorrecto.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPSconnect - Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/iniciar_sesion.css">
    <link rel="stylesheet" href="../css/prueba3.css">

</head>
<body>
    <header>
        <div class="container">
            <a class="logo" href="#">
                <img src="../imagenes/LogoGPS_sinfondo.png" alt="Logo de GPSconnect" class="logo-img">
            </a>
            <nav>
                <ul>
                    <li><a href="../html/index.html#somos-proya">Quienes somos</a></li>
                    <li><a href="../html/index.html#nuestros-programas">Nuestros Servicios</a></li>
                    <li><a href="../html/index.html#caracteristicas">Características</a></li>
                    <li><a href="../html/index.html#contactanos">Contáctanos</a></li>
                    <li><a href="../html/index.html#preguntas_frecuentes">Preguntas Frecuentes</a></li>
                    <li><a href="../html/index.html#productos">Productos</a></li>
                    <li><a href="../html/index.html#comentarios">Comentarios</a></li>
                    <li><a href="../html/iniciar_sesion.html">Iniciar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section id="iniciar_sesion" class="section-padding">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <?php
            if (!empty($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
            }
            ?>
            <form action="iniciar_sesion.php" method="post">
                <div class="form-group">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
