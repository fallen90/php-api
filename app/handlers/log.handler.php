<?php
    class Log extends Handler {
       public static function create($details){
       		$details = json_encode($details);
       		file_put_contents("logs/" . time() . ".json", $details);
       }
    }
