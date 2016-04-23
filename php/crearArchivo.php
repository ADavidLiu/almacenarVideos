<?php
    
    // Crea la conexión
    include "conexion.php";

    // Recibe el nombre del archivo a buscar
    $nombreBuscar = $_POST["nombre"];

    // Nombre de la carpeta
    $carpeta = 'descargas';
    
    // Si la carpeta no existe, la crea
    if (!file_exists($carpeta)) {
        $oldmask = umask(0);
        mkdir ($carpeta, 0744);
    }

    // Función para crear los archivos
    function base64_a_archivo ($stringBase64, $archivoSalida) {
        $ifp = fopen($archivoSalida, "wb");
        $data = explode(',', $stringBase64);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        return $archivoSalida;
    }
    
    // Trae los resultados
    $sql = "SELECT * FROM archivos WHERE nombre = '$nombreBuscar'";
    $resultados = $conexion->query($sql);
    
    // Recorre los resultados
    if ($resultados->num_rows > 0) {
        while($ocurrencia = $resultados->fetch_assoc()) {
            // Obtiene los valores de cada columna de la ocurrencia
            $nombre = $ocurrencia["nombre"];
            $archivo = $ocurrencia["archivo"];
            $ext = $ocurrencia["extension"];
            
            // Crea el nombre del archivo
            $nombreArchivo = $carpeta . '/' . $nombre . '.' . $ext;
            
            // Llama a la función para crear el archivo respectivo
            base64_a_archivo($archivo, $nombreArchivo);
        }
    }
    
    // Cierra la conexión
    $conexion.close();

?>