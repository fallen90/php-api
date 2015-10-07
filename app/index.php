<?php

error_reporting(E_ALL ^ E_DEPRECATED ^ E_WARNING);

header("Content-Type: application/json");
header("X-Powered-By: Coffee and Cobra, and also, don't forget Sting !");

include_once(dirname(__FILE__) . "/autoload.php");

// $compress = new Compression();
$api = new Api();
$ctrlsHandler = new Controller();
$database = new Database(HOST, USER, PASS, DB);