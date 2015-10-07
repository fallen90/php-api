<?php
class Model {
    private $columns = [];
    private $data = [];
    private $model_name = "";
    private $database;
    public function __construct($model_name, $user_values = []){
         $this->database = new Database();
        $this->model_name = strtolower($model_name);
        try {
            if( ($this->columns = $this->database->show_columns($this->model_name)) ) {
                foreach($this->columns as $key=>$value){
                    if(count($user_values) >= 1) {
                        $this->{$value['Field']} = isset($user_values[$value['Field']]) ? $user_values[$value['Field']] : null;
                    } else {
                        $this->{$value['Field']} = null;
                    }
                }
                $this->data = $this->database->select($this->model_name,"*");
            } else {
                Response::json_response([
                    'status' => 1,
                    'status_msg' => "Model cannot be created from non-existent data-source",
                    'context' => [
                        'model_name' => $this->model_name,
                        'user_values' => $user_values
                    ]
                ]);

            }
        } catch (Exception $e) {
           Response::json_response([
                'status' => 1,
                'status_msg' => "Model cannot be created from non-existent data-source",
                'context' => [
                    'exeption' => $e,
                    'model_name' => $this->model_name,
                    'user_values' => $user_values
                ]
            ]);
        }
        return $this;
    }
    public function __set($key, $value) {
        $this->{$key} = $value;
    }
    public function __get($key){
        if(property_exists($this, $key)){
            return $this->{$key};
        } else {
            return null;
        }
    }
    public function get_props($shift_id = false){
        $cs = [];
        foreach($this->columns as $c){
            $cs[] = $c['Field'];
        }
        if($shift_id)
            unset($cs[0]);
        
        return $cs;
    }
    public function get_current_props(){
        $props = get_object_vars($this);
        unset($props['columns']);
        return $props;
    }
    //crud-----------
    public function add(){
        $request = new Request();
        if($request->server->request_method == "POST" && count(json_decode(json_encode($request->post),true)) < 1){
            Response::error_response("No fields recieved on add request");
        } else if($request->server->request_method == "POST"){
            if(($id = $this->database->insert($this->model_name, json_decode(json_encode($request->post),true))->insert_id)){
                Response::json_response([
                        "status_msg" => ucwords(rtrim($this->model_name, "s")) . " added!",
                        rtrim($this->model_name, "s") . "_id" => $id
                    ]);
            } else {
                Response::error_response("Failed to add " . ucwords(rtrim($this->model_name,"s")));
            }
        } else {
            Response::error_response("Wrong method/data type for request.");
        }
    }
    public function edit(){
        $request = new Request();
        if($request->server->request_method == "POST" && count(json_decode(json_encode($request->post),true)) == 1){
            //id only. ids are pre generated
            Response::error_response("No fields recieved on update request");
        } else if($request->server->request_method == "POST" && count(json_decode(json_encode($request->post),true)) > 1){
            if($this->database->update_by_id($this->model_name, json_decode(json_encode($request->post),true))){
                Response::json_response([
                        'status_msg' => ucwords(rtrim($this->model_name, "s")) . " updated!",
                        rtrim($this->model_name, "s") . "_id" => $request->item
                    ]);
            } else {
                 Response::json_response([
                        'status_msg' => "Failed to update " . ucwords(rtrim($this->model_name,"s")),
                        rtrim($this->model_name, "s") . "_id" => $request->item
                    ]);
            }
        } else {
            Response::error_response("Wrong method/data type for request.");
        }
    } 
    public function delete(){
        $this->database->delete($this->model_name, rtrim($this->model_name, 's') . '_id', $key);
        return [
            'status' =>0,
            'status_msg' => ucwords(rtrim($this->model_name, 's') . ' deleted')
        ];
    }
    public function all(){
        $item_r = [];
        $model = rtrim($this->model_name,"s") . "_";
        foreach($this->data as $k=>$dat){
            foreach($dat as $key=>$value){
                $item_r[$k][str_replace($model,"",$key)] = $value;
            }
        }
        return $item_r;
    }
    public function item($id){
        $item = null;
        foreach($this->data as $k=>$v){
            if($v[rtrim($this->model_name,"s") . '_id'] == $id){
                $item = $v;
            }
        }
        if($item != null){
            $item_r = [];
            $model = rtrim($this->model_name,"s") . "_";
            foreach($item as $key=>$value){
              $item_r[str_replace($model,"",$key)] = $value;
            }
            $item = $item_r;
            return  [ rtrim($this->model_name,"s") => $item ];
        } else {
            return ['status' => 1, 'status_msg' => ucwords(rtrim($this->model_name,"s")) . ' not found or unavailable.'];
        }
    }
}