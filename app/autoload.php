<?php
set_error_handler([new Autoloader(), "xhandler"],E_ALL);
register_shutdown_function([new Autoloader(),"fatal_handler"]);
Autoloader::load_config();

// nullifies existing autoloaders
spl_autoload_register(null, false);
spl_autoload_extensions('.php, .base.php, .handler.php, .support.php');

spl_autoload_register('Autoloader::BaseLoader');
spl_autoload_register('Autoloader::HandlersLoader');
spl_autoload_register('Autoloader::ModelsLoader');
spl_autoload_register('Autoloader::SupportsLoader');
spl_autoload_register('Autoloader::ControllersLoader');



class Autoloader {

    private static function autoload($base, $classname){
        $location = [
                     'base' => "base/", 
                     'handler' => "handlers/",
                     'model' => "models/",
                     'support' => "supports/",
                     'controller' => "controllers/"
                    ];

        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . $location[$base] . strtolower($classname) . '.' . $base . '.php';
        if(!file_exists($filename)){
            return false;
        }

        include_once $filename;
    }
    public static function BaseLoader($classname){
       self::autoload('base',$classname);
    }
    public static function HandlersLoader($classname){
       self::autoload('handler',$classname);
    }
    public static function ModelsLoader($classname){
       self::autoload('model',$classname);
    }
    public static function SupportsLoader($classname){
       self::autoload('support',$classname);
    }
    public static function ControllersLoader($classname){
       self::autoload('controller',$classname);
    }
    public static function load_config(){
        $config_path = ".config";
        $config_lines = file($config_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($config_lines as $lines){
            $line = explode("=",$lines);
            define($line[0],$line[1]);
        }
    }
    public function xhandler($code,$string,$file,$line,$context){
        ob_get_clean();
        header("Content-Type: application/json");
        http_response_code(500);
        Response::json_response([
            "status" => "1",
            "status_msg" => "error",
            "error_type" => $code,
            "error_message" => $string,
            "file_name" => $file,
            "line_number" => $line,
            "context" => $context
          ]);
        exit();
    }
    public function fatal_handler() {
      $errfile = "unknown file";
      $errstr  = "shutdown";
      $errno   = E_CORE_ERROR;
      $errline = 0;

      $error = error_get_last();

      if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];
        $this->xhandler(E_ERROR, $error['message'], $error['file'], $error['line'], null);
      }
    }
}