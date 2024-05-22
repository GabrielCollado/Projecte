<?php
$targetDirectory = "../uploads";


$items = scandir($targetDirectory);

$items = array_diff($items, array('.', '..'));


$files = array();
$folders = array();


foreach ($items as $item) {
    $path = $targetDirectory . '/' . $item;
    if (is_dir($path)) {
        $folders[] = $item;
    } else {
        $files[] = $item;
    }
}


$result = array(
    "files" => $files
);

echo json_encode($result);
?>