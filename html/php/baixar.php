<?php
if(isset($_GET['archivo'])) {
    $rutaArchivos = '../uploads/';
    $archivo = $_GET['archivo'];
    $rutaCompleta = $rutaArchivos . $archivo;
    
    if(file_exists($rutaCompleta)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($rutaCompleta) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($rutaCompleta));
        
        
        readfile($rutaCompleta);
        exit;
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se ha especificado ningún archivo.";
}
?>