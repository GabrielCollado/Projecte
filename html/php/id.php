<?php
if (isset($_FILES['arxiu'])) {
    $file = $_FILES['arxiu'];

    $api_key = 'ec7c2c18ad8c2a7e0835a81abe005a3dc5b2aaf5d0c118bd50e5c0c43c2dd075';
    $url = 'https://www.virustotal.com/vtapi/v2/file/scan?' . rand();

    $post_data = array(
        'apikey' => $api_key,
        'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name'])
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Error cURL: ' . curl_error($ch);
    } else {
        $response_data = json_decode($response, true);

if ($response_data && isset($response_data['scan_id'])) {
    $id = $response_data['scan_id'];
} else {
    echo "No se pudo obtener el ID del análisis.";
}
}
}

curl_close($ch);
?>