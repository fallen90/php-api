<?php
    class Request extends Handler {
        public $filters = null;
        public function __construct(){
            parent::__construct();
            if(isset($_FILE) && count($_FILE) >= 1){
                $this->set_props("file",$_FILE);
            }
            if(isset($_FILES) && count($_FILES) >= 1){
                $this->set_props("files",$_FILES);
            }
            if(isset($_GET) && count($_GET) >= 1) {
                $this->set_props("get",$_GET);
                $this->type = "get";
            } 
            if(isset($_POST) && count($_POST) >= 1) {
                $this->set_props("post",$_POST);
                $this->type = "post";
            }
            $this->set_props("server",$_SERVER);

        }
        public function __get($name){
            if(isset($this->{$name})){
                return $this->$name;
            } else {
                return $this->{$name} = new StdClass($name);
            }
        }
        public function remove($key){
            if(property_exists($this, $key)){
                unset($this->{$key});
            } else {
                return false;
            }
        }
        private function set_props($type, $arr){
            foreach($arr as $k=>$r){
                if($k == "filters" && $r != ""){
                   $this->set_filters($type, $r);
                } else if($k == 'action' && $r != ""){
                    $action = explode("/",$r);
                    $this->{$type}->action = $r;
                    $this->model = $action[0];
                    $this->method = (isset($action[2])) ? $action[2] : $action[1];
                    $this->item = (count($action) == 3) ? $action[1] : null;
                    $this->post->{rtrim($this->model,'s') . '_id'} = ($this->item != null) ? $this->item : null;
                } else {
                    $this->{$type}->{strtolower($k)} = rtrim($r,"/");
                }
            }
        }
        private function set_filters($type, $filter_str){
            $filter_str = ltrim($filter_str, "(");
            $filter_str = rtrim($filter_str,")");
            $filter_sets = explode(",",$filter_str);
            $filters = [];
            foreach($filter_sets as $set){
               if(strpos($set, ":")){
                    $setx = explode(":",$set);
                    $filters[$setx[0]] = $setx[1];
               }
            }
            $filters = array_filter($filters);
            $this->filters = $filters;
            $this->{$type}->filters = $filters; 
        }
        // private function set_filters($filter_str){
        //     $filter_json = explode("=",$filter_str)[1];
        //     $this->filters = json_decode($filter_json);
        // }
    }
