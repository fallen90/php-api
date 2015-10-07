<?php
final class Response {

    private function __construct(){} //singleton

    public static function _response($code, $code_msg, $add_fields = []){
        $resp = ['status' => $code, 'status_msg' => $code_msg ];
        if($add_fields != null){
            foreach($add_fields as $key=>$field){
               $resp[$key] = $field;
            }
        }
        exit(json_encode($resp));
    }

    public static function error_response($code_msg = "error", $code = 1){
        self::_response($code, $code_msg);
    }

    public static function success_response($code_msg = "success",$code = 0){
        self::_response($code, $code_msg);
    }
    
    public static function json_response($obj_array){
        self::_response(0, "success", $obj_array);
    }

}