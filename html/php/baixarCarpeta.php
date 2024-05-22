<?php

function agregarArchivosAlZip($rutaCarpeta, $zip) {
    $archivos = glob($rutaCarpeta . '/*');
    if ($archivos === false) {
        return false; 
    }
    foreach ($archivos as $archivo) {
        if (is_dir($archivo)) {
            
            if (!agregarArchivosAlZip($archivo, $zip)) {
                return false; 
            }
        } else {
            
            $nombreArchivo = basename($archivo);
            if (!$zip->addFile($archivo, $nombreArchivo)) {
                return false; 
            }
        }
    }
    return true; 
}

if(isset($_GET['carpeta']) && !empty($_GET['carpeta'])) {
    $carpeta = $_GET['carpeta'];
    $rutaCarpeta = '../uploads/' . $carpeta;

    
    $archivoZip = $carpeta . '.zip';

    
    $zip = new ZipArchive();
    if ($zip->open($archivoZip, ZipArchive::CREATE) !== TRUE) {
        die("Error al crear el archivo ZIP");
    }

    
    if (!agregarArchivosAlZip($rutaCarpeta, $zip)) {
        die("Error al agregar archivos al archivo ZIP");
    }
    
    $zip->close();

    
    if (!file_exists($archivoZip)) {
        die("Error: El archivo ZIP no se creó correctamente");
    }

    
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $archivoZip);
    header('Content-Length: ' . filesize($archivoZip));
    if (!readfile($archivoZip)) {
        die("Error al enviar el archivo ZIP al cliente");
    }

    
    if (!unlink($archivoZip)) {
        die("Error al eliminar el archivo ZIP");
    }

} else {
    echo "La carpeta no está especificada o es inválida.";
}
?>