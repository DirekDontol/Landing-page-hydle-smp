<?php
header('Content-Type: application/json');

// Pengaturan IP Server Minecraft kamu
$server_ip = "play.hydlesmp.fun"; 

// Menembak API gratis dari mcsrvstat untuk mengecek status game server
$api_url = "https://api.mcsrvstat.us/3/" . $server_ip;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

$output = [
    'online' => false,
    'players' => 0
];

if ($data && isset($data['online'])) {
    $output['online'] = $data['online'];
    $output['players'] = isset($data['players']['online']) ? $data['players']['online'] : 0;
}

echo json_encode($output);
?>
