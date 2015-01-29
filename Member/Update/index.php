<?php
use Enterprise\Service;

require_once '../../loader.php';

$service = new Service();

$params = array(
    "username"=>"doogle",
    "refresh_token" => "sdfsdafdsfdsf",
    "access_token" => "dsdscvcxvcxxcv",
    "expiration" => "pppppdddddpd",
    "client_id" => "ccccccc"
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

echo json_encode($message);

exit();