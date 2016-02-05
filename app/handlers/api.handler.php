<?php
class Api extends Handler {
    public function __construct(){
        parent::__construct();
        $request = new Request();
        if($request->type =="get" && isset($request->get->action)){
            $action = $request->get->action;
            if(strpos($action,"/") !== false){
                $action_recv = array_filter(explode("/",$action));
                $action = $action_recv[0];

                if(count($action_recv) >= 1){
                    if(is_string($action_recv[1]) && !is_numeric($action_recv[1])){
                        $method = $action_recv[1];
                    } elseif (is_numeric($action_recv[1]) && !isset($action_recv[2])){
                        $arg = $action_recv[1];
                    } else { //argument
                        $arg = [$action_recv[1],$action_recv[2]];
                    }
                }
            }

            // if(class_exists($action = ucwords($action))){ //it's a class
            //     echo "fucky";
            //     if(isset($method) && $method != ""){ // and method is present
            //         if(method_exists($action = new $action(), $method)){ //and existing
            //             $action->{$method}();
            //         } else {
            //             Response::error_response("The method '"  . $method .  "' of class '" . get_class($action) . "' doesn't exists or not implemented");
            //         }
            //     } else { //else, run default
            //         $action = new $action();
            //         $action->index();
            //     }
            // } 

            if(class_exists($action =  ucwords($action))){

                $obj = new $action();

                if(isset($method) && $method != ""){
                    if(method_exists($obj, $method)){
                        $obj->{$method}();
                    } else {
                        Response::error_response("The method '"  . $method .  "' of class '" . get_class($obj) . "' doesn't exists or not implemented");
                    }
                } else {
                    $obj->index();
                }
                exit();
            }
            
            if(method_exists($this, $action)){ // else it's a method only (bultin)
                $this->{$action}();
            } else if( ($model = new Model($action)) != null){ //or can be generated model
                if(isset($method)){
                    if(method_exists($model, $method)){
                        Response::json_response($model->{$method}());
                    } else {
                        Response::error_response("Action '"  . $method .  "' doesn't exists");
                    }
                } else {
                    if(isset($arg) && count($arg) == 1){
                        Response::json_response($model->item( (!is_array($arg)) ? $arg : $arg[0] ));
                    } elseif(isset($arg) && count($arg) > 1) {
                        if(!method_exists($model, $arg[1])){
                            Response::error_response("'"  . $arg[1] .  "' doesn't exists");
                        } else {
                            Response::json_response($model->{$arg[1]}($arg[0]));
                        }
                    } else {
                        $data = $model->all();
                        Response::json_response([strtolower($action) . '_count'=> count($data), strtolower($action)=>$data]);
                    }
                }
            } else {
                Response::error_response("'"  . $action .  "' doesn't exists");
            }
            exit(0);
        } else if($request->type == "post"){
            $model = new Model($request->model);
            if($model != null){
                if(method_exists($model, $request->item)){
                    $request->method = $request->item;
                }
                if(method_exists($model, $request->method)){
                    $model->{$request->method}();
                } else {
                    Response::error_response($request->method . ' not found on method list');
                    // Response::json_response($request);
                }
            }
        } else {
            $this->index();
        }
    }
}