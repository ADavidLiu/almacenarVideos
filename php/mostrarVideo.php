<?php

    include "conexion.php";

    $nombre = $_POST["nombre"];

    $sql = "SELECT * FROM archivos WHERE nombre = '$nombre'";
    $resultados = $conexion->query($sql);

    if ($resultados->num_rows > 0) {
        while($ocurrencia = $resultados->fetch_assoc()) {
            $archivo = $ocurrencia["archivo"];    
            echo $archivo;
        }
    }

    $conexion->close();

?>