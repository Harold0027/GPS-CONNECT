<?php
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = "";
    $baseDeDatos = "gps_connect";
    $puerto = 3306;

    $enlace = mysqli_connect($servidor, $usuario, $contraseña, $baseDeDatos, $puerto);

    if(!$enlace) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    if(isset($_POST['mensaje'])){
        $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($enlace, $_POST['apellido']);
        $telefono = mysqli_real_escape_string($enlace, $_POST['telefono']);
        $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
        $mensaje = mysqli_real_escape_string($enlace, $_POST['mensaje']);

        $insertarDatos = "INSERT INTO contactanos (nombre, apellido, telefono, correo, mensaje) VALUES ('$nombre', '$apellido', '$telefono', '$correo', '$mensaje')";

        if(mysqli_query($enlace, $insertarDatos)){
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar datos: " . mysqli_error($enlace);
        }
    }

    mysqli_close($enlace);
?>
