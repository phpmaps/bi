<?php
namespace Enterprise;

define('APPATH', dirname(__FILE__));

function loader($file){

    $classes = array(
        APPATH . DIRECTORY_SEPARATOR . 'Service.php',
        APPATH . DIRECTORY_SEPARATOR . 'Log.php',
        APPATH . DIRECTORY_SEPARATOR . 'Utils.php',
        APPATH . DIRECTORY_SEPARATOR . 'Geoenrich.php',
        APPATH . DIRECTORY_SEPARATOR . 'Geocode.php'
    );

    foreach ($classes as $k => $file){

        $file = sprintf('%s', $file);

        if(is_file($file) && !class_exists($file) ){

            include_once $file;

        }

    }
}

if(!function_exists('loader')){

    spl_autoload_register('Enterprise\loader');

}