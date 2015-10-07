<?php

class Controller extends Handler {
    public function __construct(){
        $files = glob("controllers/*.controller.php");
        foreach($files as $file){
            $file = ucwords(str_replace("controllers", "", str_replace(".controller.php", "", $file)));
            $file = new $file();
        }
    }
}