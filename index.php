<?php
use Enterprise\Service;
require_once 'loader.php';

$service = new Service();
$geoenrich = new Geoenrich();
$geocode = new Geocode();


$r = $service->selectNewCustomerRecords();
$r = $service->convertPdoArrayToAGSRecords($r);
//$service->debug($r);

$params = $geocode->prepareParameters($r);
$r = $geocode->geocodeAddresses($params);
//$geocode->debug($r);

$results_array = json_decode($r, true);
$results_array = $results_array['locations'];
foreach($results_array as $key => $value){
    $geom = sprintf("[{'geometry':{'x':%s,'y':%s}}]", $value['location']['x'], $value['location']['y']);
    $geocode->debug($geom);
    $geoenrich_results = $geoenrich->enrich($geom);
    $geoenrich->debug($geoenrich_results);
}



exit();
$geoenrich = new Geoenrich();
$r = $geoenrich->enrich();

echo "<pre>";
print_r($r);
echo "</pre>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


