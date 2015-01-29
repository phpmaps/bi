<?php
use Enterprise\Service;
use Enterprise\Log;

require_once '../../../loader.php';

$service = new Service();

$log = new Log("start of chron refresh");

$collection = $service->selectAccountRecords();

foreach($collection as $row)
{
    $refresh_token = $row['refresh_token'];
    
    $result = $service->refreshTokenToAccessToken($refresh_token);
    
    $params = array(
        'username' => $result['username'],
        'access_token' => $result['access_token'],
        'refresh_token' => $refresh_token,
        'expires_in' => $result['expires_in']
    );
    
    $isStored = $service->updateAccount($params);
    
    $log->log("username and access token");
    
    $log->log("username: " . $result['username']);
    $log->log("access_token: " . $result['access_token']);
    $log->log("refresh_token: " . $refresh_token);
    $log->log("expires_in: " . $result['expires_in']);

}

$log->log('end of chron refresh');