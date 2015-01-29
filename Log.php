<?php
namespace Enterprise;

error_reporting(0);

class Log {

    public $timeFormat = 'm-d-y H:i:s';

    public $seperator = ' | ';

    public $eol = "\r\n";

    public $indent = " ";
    
    public $path;


    public function __construct($message = null) 
    {
    	
        	$this->path = APPATH;
    	
        	if($message != null){
        	    
        	    $this->log($message);
        	    
        	}
    	
    }

    public function write($m)
    {

        if (isset($this->path)) {

            try {

                $fh = null;
                
                $logfile = $this->path . "/ebs.log";
                
                $fh = (file_exists($logfile)) ? fopen($logfile, "a+") : fopen($logfile, "w+");

                 fwrite($fh, $this->eol);

                    fwrite($fh, $this->getTime());

                    fwrite($fh, $this->seperator);

                    fwrite($fh, $m);

                fclose($fh);

            } catch (\Exception $e) {

                $this->log($e->getMessage());

            }
        } else {

            error_log('Log.php - Error writing log file.', 0);

        }
    }

    public function log($message)
    {

        $this->write($message); 

    }

    public function getTime() {

        return date($this->timeFormat);
    }

    function __destruct()
    {
    }

}