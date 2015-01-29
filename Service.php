<?php
namespace Enterprise;

class Service extends Utils
{
    public $log;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 
     * @param string
     * @return array
     * @example
     * params code
     * return array('access_token','refresh_token','username','expires_in')
     *
     */
    
    public function authCodeToAccessToken($code)
    {
        $settings = $this->config;
        $client_id = $settings['arcgis']['client_id'];
        $grant_type = "authorization_code";
        $redirect_uri = $settings['arcgis']['redirect_uri'];
        
        if(empty($client_id) || empty($redirect_uri)){
            
            $this->log->log("client id or redirect uri missing from config.");
            
            exit();
        }
        
        $params = array(
            'client_id'=>$client_id,
            'code'=>$code,
            'grant_type'=>$grant_type,
            'redirect_uri'=>$redirect_uri
        );

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.arcgis.com/sharing/oauth2/token/");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            echo "error";
            error_log($e->getMessage(), 0);
        }
        
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $header_size);

        $array = json_decode($body, true);
        
        return $array;
        
    }
    
    /**
     *   
     * @param string
     * @return array
     * @example
     * params refresh_token
     * return array('access_token','expires_in','username')
     *
     */
    
    public function refreshTokenToAccessToken($refresh_token)
    {
        $settings = $this->config;
        $client_id = $settings['arcgis']['client_id'];
        $grant_type = "refresh_token";
        
        if(empty($client_id)){
        
            $this->log->log("client id or redirect uri missing from config.");
        
            exit();
        }
        
        $params = array_merge(
            array('refresh_token' => $refresh_token),
            array(
                'client_id' => $client_id, 
                'grant_type'=> $grant_type
            )
        );
            
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.arcgis.com/sharing/rest/oauth2/token/");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            $response = curl_exec($ch);
        } catch (\Exception $e) {
            echo "error";
            error_log($e->getMessage(), 0);
        }
        
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $header_size);
        $this->log->log($body);
        $array = json_decode($body, true);
        return $array;
        
    }
    
}