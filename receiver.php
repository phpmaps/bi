<?php

use Enterprise\Service;
require_once 'loader.php';

$code = $_GET['code'];

$params = array(
    'client_id' => "uon4LzOdmDILmC8M",
    'code' => $code,
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'https://localhost/bi/receiver.php'
);


try {
    $ch = curl_init();             //https://www.arcgis.com/sharing/oauth2/token/
    curl_setopt($ch, CURLOPT_URL, "https://www.arcgis.com/sharing/oauth2/token/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
} catch (Exception $e) {
    echo "error";
    error_log($e->getMessage(), 0);
}

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$body = substr($response, $header_size);

//echo $body;

$json = json_decode($body, true);
$token = $json['access_token'];
$refresh_token = $json['refresh_token'];
$username = $json['username'];



#######TEST GETTING NEW TOKEN FROM REFRESH TOKEN#######


$params = array(
    'client_id' => "uon4LzOdmDILmC8M",
    'refresh_token' => $refresh_token,
    'grant_type' => 'refresh_token'
);


try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.arcgis.com/sharing/rest/oauth2/token/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
} catch (Exception $e) {
    echo "error";
    error_log($e->getMessage(), 0);
}

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$body = substr($response, $header_size);

echo $body;

$json = json_decode($body, true);
$token = $json['access_token'];
$expires_in = $json['expires_in'];



####################Store Refresh Token########

$service = new Service();

$params = array(
	'email' => $username,
	'refresh_token' => $refresh_token
);

$result = $service->updateAccount($params);

header('Status: 200', true, 200);
header('Content-Type: application/json');

if($result){
    
    $message = array("code" => 200, "details" => "All is good!");
    
}else{
    
    $message = array(
        "error" => array("code" => 500,
            "details" => array("Cannot make a connection."),
            "message" => "Failed could not connect to database."
        )
    ); 
}

//echo json_encode($message) . "<br><br>";



####################GeoEnrich Part#################

$params = array(
    'token' => $token,
    'f' => 'json',
    'analysisVariables' =>'["Wealth.MEDHINC_CY"]',
    'studyAreas' => "[{'geometry':{'x':-117.1956,'y':34.0572}}]"
);


try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://geoenrich.arcgis.com/arcgis/rest/services/World/GeoenrichmentServer/Geoenrichment/enrich");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
} catch (Exception $e) {
    echo "error";
    error_log($e->getMessage(), 0);
}


$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$body = substr($response, $header_size);

echo $body;

//$json = json_decode($body, true);
//$token = $json['access_token'];
//$token = json_decode($token);
//var_dump($token);



############Geoenrich Part############