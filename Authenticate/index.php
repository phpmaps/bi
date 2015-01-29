<?php
use Enterprise\Service;
use Enterprise\Log;

require_once '../loader.php';

$service = new Service();

$log = new Log();

$code = $_GET['code'];

if(empty($code)){
    
    echo "No code, no bueno!";
    
    $log->log("no code to authenticate");
    
    exit();
}

$params = $service->authCodeToAccessToken($code);

$message = json_encode($params);

$isStored = $service->updateAccount($params);

if($isStored){

    $message = array("code" => 200, "details" => "All is good!");
    
    header("Location: http://localhost/bi/maps/");
    
    die();

}else{

    $message = array(
        "error" => array("code" => 500,
            "details" => array("Cannot make a connection."),
            "message" => "Failed could not connect to database."
        )
    );
}

echo json_encode($message);