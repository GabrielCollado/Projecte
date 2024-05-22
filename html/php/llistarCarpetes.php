<?php
$targetDirectory = "../uploads";

$items = scandir($targetDirectory);

$items = array_diff($items, array('.', '..'));

$foldersWithContent = array();

foreach ($items as $item) {
    $path = $targetDirectory . '/' . $item;
    if (is_dir($path)) {
        $folderContent = array();
        $subItems = scandir($path);
        $subItems = array_diff($subItems, array('.', '..'));
        foreach ($subItems as $subItem) {
            $subPath = $path . '/' . $subItem;
            $folderContent[] = $subItem;
        }
        $foldersWithContent[$item] = $folderContent;
    }
}

echo json_encode($foldersWithContent);
?>