<?php

use Enterprise\Utils;
/** 
 * @author doug5997
 * 
 */
class Geoenrich extends Utils
{
    // TODO - Insert your code here
    
    /**
     */
    
    public $log;
    
    function __construct()
    {
        
        parent::__construct();
    }
     
    public function enrich($geometry)
    {
        $params = array(
            'token' => $this->token,
            'f' => 'json',
            'analysisVariables' =>'["Wealth.MEDHINC_CY", "clothing.X5029_X"]',
            'studyAreas' => $geometry
        );
        
        /**
        $params = array(
            'token' => $this->token,
            'f' => 'json',
            'analysisVariables' =>'["Wealth.MEDHINC_CY", "clothing.X5029_X"]',
            'studyAreas' => "[{'geometry':{'x':-117.1956,'y':34.0572}}]"
        );
        **/
        
        
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
        
        //echo $body;
        
        $array = json_decode($body, true);
        return $array;
//         echo "<pre>";
//         print_r($array);
//         echo "</pre>";
//         echo "<br>";
//         echo "<br>";
//         echo "<br>";
//         echo "<br>";
//         echo "<br>";
        
//         echo "<pre>";
//         $attributes = $array['results'][0]['value']['FeatureSet'][0]['features'][0]['attributes'];
//         echo $attributes['sourceCountry'];
//         echo "</pre>";
    }
    
    
    function __destruct()
    {
        
        // TODO - Insert your code here
    }
}

?>