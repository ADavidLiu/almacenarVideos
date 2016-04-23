<?php

    include "conexion.php";

    $archivo = $_POST['archivo'];
    $nombre = $_POST['nombre'];
    $ext = $_POST['extension'];

    $sql = "INSERT INTO archivos (archivo, nombre, extension) VALUES ('$archivo', '$nombre', '$ext')";
    $conexion->query($sql);

    $conexion->close();

?>