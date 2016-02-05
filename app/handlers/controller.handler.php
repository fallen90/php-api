<?php

class Controller extends Handler {
	public $request;
	public $db;
    public function __construct(){
        global $database;
    	$this->request = new Request();
    	$this->db = new Database(HOST, USER, PASS, DB);
        $files = glob("controllers/*.controller.php");
        foreach($files as $file){
            $file = ucwords(str_replace("controllers", "", str_replace(".controller.php", "", $file)));
            $file = new $file();
        }
    }
}