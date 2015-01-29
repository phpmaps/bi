<?php

use Enterprise\Utils;
/** 
 * @author doug5997
 * 
 */
class Geocode extends Utils
{

    public $ch;
    
    public $url;
    
    function __construct()
    {
        parent::__construct();
    }
 
    public function build_http_query($query) //Support for older PHP versions here
    {
        $query_array = array();
        foreach($query as $key => $value ){
            $query_array[] = $key . '=' . $value;    
        }
        return implode( '&', $query_array);
    }
    
    public function prepareParameters($payload)
    {
        $data = array("f"=>"json", "token"=>$this->token, "outSR"=>4326, "addresses"=>$payload);
        $data = $this->build_http_query($data);
        return $data;    
    }

    public function geocodeAddresses($records)
    {

        
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/geocodeAddresses");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $records);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $response = curl_exec($ch);
        } catch (Exception $e) {
            echo "error";
            error_log($e->getMessage(), 0);
        }
  
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $header_size);
        $array = json_decode($body, true);
        return $body;
    }

    function __destruct()
    {
        
    }
}

?>