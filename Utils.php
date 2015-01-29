<?php

namespace Enterprise;

/**
 *
 * @author doug5997
 *        
 */



class Utils
{
    public $dbpath;
    
    public $config;
    
    private $connection;
    
    public $log;
    
    public $dbname = "machine.sqlite";
    
    public $con;
    
    public $token;
    
    public $bool = array(true=>"True", false=>"False");
    
    
    function __construct()
    {
        $this->log = new Log(null);
        
        $this->dbpath = APPATH . DIRECTORY_SEPARATOR  . "Database" . DIRECTORY_SEPARATOR;
        
        $this->getConfig();

        $this->getDatabaseConnection();
        
        $this->token = "iTcE8uMeX8_CvFvkz2AlZ_BgKJNbMiZvNQJ2biuKte8_i14T_oXHS2OIHbb1eZ3e6LXFdd71V6VUKwbMwH0NCoMZzWbVo2fWvwrCp_tc4WU9dcfvyQ8aFWGS-LVQRuO7VjyvndWGHV5LPS4D1CwyOuby0JarPaoJnZ9PuN9Z91HQ92oU8mlvwjI1ATIcBzBk";
    }
    
    public function quote($value)
    {
        $item = sprintf("'%s'", $value);
        
        return $item;
    }
    
    public function hasPrefix($value, $prefix)
    {
        return stripos($value, $prefix) === 0;
        
    }
    
    public function getConnection()
    {
        if($this->con != null)
        {
            
            return $this->con;
            
        }else{           
            
            $this->log->log('Cannot get a connection');
            
            header('Status: 200', true, 200);
            
            header('Content-Type: application/json');
            
            $serverError = array(
                "error" => array("code" => 500,
                    "details" => array("Cannot make a Sqlite database connection.  Check to see if it exists.  If it does, consider backing up and then deleting sqlite database."),
                    "message" => "Failed could not connect to sqlite database."
                ));
            
            echo json_encode($serverError);
            
            exit();
        }
    }
    
    public function makeDirectory($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir,$mode)) return true;
        
        if (!$this->makeDirectory(dirname($dir),$mode)) return false;
        
        return @mkdir($dir,$mode);
    }
    
    public function getDatabaseConnection()
    {
        $this->log->log($this->dbname);
        
        try {
            if(file_exists($this->dbpath . $this->dbname))
            {
                $db = new \PDO("sqlite:" . $this->dbpath . $this->dbname);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->con = $db;
                return $this->con;
            }
        }
        catch(\ErrorException $e)
        {
            $this->log->log($e->getMessage());
            return null;
        }
        try {
            
            $db = new \PDO("sqlite:" . $this->dbpath . $this->dbname);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            chmod($this->dbpath . $this->dbname,0777);
            if($db != null){
                $db->beginTransaction();
                $this->createAccountsTable($db);
                $db->commit();
                $this->con = $db;
            }
            return $this->con;
        }
        catch(\PDOException $e)
        {
            $this->log->log($e->getMessage());
            return null;
        }
    }
    
    public function createAccountsTable($db)
    {
        
        try {
            $db->exec("CREATE TABLE IF NOT EXISTS accounts (
                id INTEGER PRIMARY KEY,
                username VARCHAR(255),
                access_token VARCHAR(255),
                refresh_token VARCHAR(255),
                client_id VARCHAR(255),
                expires_in INTEGER,
                time INTEGER)");
            $this->log->log("accounts table created!");
        }
        catch(\PDOException $e)
        {
            $this->log->log($e->getMessage());
        }
        try {
            
            $db->exec('CREATE INDEX username ON accounts (username)');
            $db->exec('CREATE INDEX client_id ON accounts (client_id)');
        }
        catch(\PDOException $e)
        {
            $this->log->log($e->getMessage());
        }
    }
    
    public function convertPdoArrayToAGSRecords($r){
        $addresses = array();
        $i = 1;
        foreach ($r as $key => $row){
            $s = new \stdClass();
            $s->OBJECTID = $i;
            foreach ($row as $k => $v){
                if(!is_numeric($k)){
                    $s->$k = $v;
                }
            }
            $std = new \stdClass();
            $std->attributes = $s;
            $addresses[] = $std;
            $i++;
        }
        
        $records = new \stdClass();
        $records->records = $addresses;
        
        $r = json_encode($records,JSON_PRETTY_PRINT);
        
        return $r;
    }
    
    public function debug($value)
    {
        echo "<br><br>";
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        echo "<br><br>";
    }
    
    
    public function selectNewCustomerRecords()
    {
        $db = $this->getConnection();
    
    
        try{
    
            $sth = $db->prepare("SELECT * FROM customers WHERE GUID = :GUID LIMIT 2");
            
            $sth->execute(array(':GUID' => '0')) or die($this->getDatabaseErrorMessage());
            
            //$r = $sth->fetchAll();
    
            $sth->execute() or die($this->getDatabaseErrorMessage());
    
            $r = $sth->fetchAll();
    
            return $r;
    
        }catch(\PDOException $e){
    
            $this->log->log("selectAccountRecords error");
    
            $this->log->log($e->getMessage());
    
        }
    
    }
    
    public function selectAccountRecords()
    {
        $db = $this->getConnection();
    
    
        try{
    
            $sth = $db->prepare("SELECT * FROM accounts");
    
            $sth->execute() or die($this->getDatabaseErrorMessage());
    
            $r = $sth->fetchAll();
    
            return $r;
    
        }catch(\PDOException $e){
    
            $this->log->log("selectAccountRecords error");
    
            $this->log->log($e->getMessage());
    
        }
    
    }
    
    public function selectAccountRecord($params)
    {
        
        $username = $params['username'];
        
        $client_id = $params['client_id'];
        
        $db = $this->getConnection();
        
        try{
            
            $sth = $db->prepare("SELECT * FROM accounts WHERE username = :username AND client_id = :client_id");
            
            $sth->execute(array(':username' => $username, ':client_id' => $client_id)) or die($this->getDatabaseErrorMessage());
            
            $r = $sth->fetchAll();
            
            return $r;
                
        }catch(\PDOException $e){
            
            $this->log->log("selectAccountRecord error");
            
            $this->log->log($e->getMessage());
            
        }
        
    }
    
    public function getDatabaseErrorMessage()
    {
        $this->log->log("A database error occured.");
        header('Status: 200', true, 200);
        header('Content-Type: application/json');
        $dbError = array(
            "error" => array("code" => 500,
                "details" => array("A database error occurred.  Consider backing up and then deleting sqlite database."),
                "message" => "Proxy failed due to database error."
            ));
        return json_encode($dbError);
    }
    
    public function updateAccountRecord($params)
    {
        $db = $this->getConnection();
        
        $microtime = microtime(true);
        
        try {
            $sth = $db->prepare("UPDATE accounts SET access_token=:access_token, refresh_token=:refresh_token, expires_in=:expires_in,username=:username,client_id=:client_id,time=:time WHERE username = :username AND client_id=:client_id");
            $sth->bindValue(':access_token', $params['access_token']);
            $sth->bindValue(':refresh_token', $params['refresh_token']);
            $sth->bindValue(':expires_in', $params['expires_in']);
            $sth->bindValue(':username', $params['username']);
            $sth->bindValue(':client_id', $params['client_id']);
            $sth->bindValue(':time', $microtime);
            $result = $sth->execute() or die($this->getDatabaseErrorMessage());
            return $result;
        }
        catch(\PDOException $e)
        {
            $this->log->log("error updateAccountRecord");
            
            $this->log->log($e->getMessage());
        }
    }
    
    public function insertAccountRecord($params)
    {
        $db = $this->getConnection();
        
        $microtime = microtime(true);
        
        try {
            $sql = "INSERT INTO accounts (id, username, access_token, refresh_token, client_id, expires_in, time) VALUES (:id,:username,:access_token,:refresh_token,:client_id,:expires_in,:time)";
            $q = $db->prepare($sql);
            $q->bindValue(':id', null);
            $q->bindValue(':username', $params['username']);
            $q->bindValue(':access_token', $params['access_token']);
            $q->bindValue(':refresh_token', $params['refresh_token']);
            $q->bindValue(':client_id', $params['client_id']);
            $q->bindValue(':expires_in', $params['expires_in']);
            $q->bindValue(':time', $microtime);
            $result = $q->execute() or die($this->getDatabaseErrorMessage());
            return $result;
        }
        catch(\PDOException $e)
        {
            $this->log->log($e->getMessage());
        }
    }
    
    public function updateAccount($params)
    {
        $settings = $this->config;
        
        $client_id = $settings['arcgis']['client_id'];
        
        if(empty($client_id)){
        
            $this->log->log("client_id missing from config.");
        
            exit();
        }
        
        $params = array_merge(
            $params,
            array(
                'client_id' => $client_id
            )
        );
        
        $resultSet = $this->selectAccountRecord($params);
        
        if(count($resultSet) > 0){
            
            $result = $this->updateAccountRecord($params);
            
        }else{
            
            $result = $this->insertAccountRecord($params);
                 
        }
        
        return $result;
        
    }
    
    private function getConfig()
    {
        if($this->config != null){
    
            return;
    
        }else{
    
            $file = APPATH . DIRECTORY_SEPARATOR . 'app.ini';
    
            if (!$this->config = parse_ini_file($file, TRUE)) {
    
                $this->log->log('Problem reading app.ini');
    
                //TODO SEND EMAIL ALERT
            }

        }
    }
    
    
    /**
     */
    function __destruct()
    {
        
        // TODO - Insert your code here
    }
}

?>