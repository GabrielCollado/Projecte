<?php
sleep(90);

$scan_id = $id;
$api_key = 'ec7c2c18ad8c2a7e0835a81abe005a3dc5b2aaf5d0c118bd50e5c0c43c2dd075';
$url = 'https://www.virustotal.com/vtapi/v2/file/report';
$params = array(
    'apikey' => $api_key,
    'resource' => $scan_id
);

$post_data = array(
    'apikey' => $api_key,
    'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name'])
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Error cURL: ' . curl_error($ch);
} else {
    $response_data = json_decode($response, true);

    if ($response_data && isset($response_data['response_code']) && $response_data['response_code'] === 1) {
        $has_virus = false;
        foreach ($response_data['scans'] as $engine => $result) {
            if ($result['detected']) {
                $has_virus = true;
                break;
            }
        }
        
        if ($has_virus) {
            echo "<script>alert('L'arxiu es malicios, no es pot pujar');</script>";
            echo "<script>window.location.href = '../principal.html';</script>";
        } else {
            echo "<script>alert('Arxiu net de virus, arxiu pujat');</script>";
            move_uploaded_file($file['tmp_name'], '../uploads/'.$file['name']);
            echo "<script>window.location.href = '../principal.html';</script>";
        }
    } else {
        echo "<script>alert('No s'ha pogut analitzar l'arxiu, torna a intentar-ho');</script>";
        echo "<script>window.location.href = '../principal.html';</script>";
    }
}

curl_close($ch);
?>