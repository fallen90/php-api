<?php
class Model {
    private $columns = [];
    private $data = [];
    private $model_name = "";
    private $database;
    private $meta;
    public function __construct($model_name, $user_values = []){
           $this->database = new Database();
        $this->model_name = strtolower($model_name);
        try {
            $this->meta = new Meta($this->model_name);
            if( ($this->columns = $this->meta->fields) ) {
                foreach($this->columns as $value){
                    if(count($user_values) >= 1) {
                        $this->{$value} = isset($user_values[$value]) ? $user_values[$value] : null;
                    } else {
                        $this->{$value} = null;
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
    public function login(){
       $request = new Request();
        // print_r($request);
       if($this->model_name == "users" && $request->server->request_method == "POST"){
          foreach($this->data as $user){
              if($user['user_pass']==$request->post->user_pass && $user['user_name']==$request->post->user_name){
                  Response::success_response("login successful");
              } else {
                  Response::error_response("login failed");
              }
          }
       } else {
           Response::error_response("failed to acknowledge action");
       }
    }
    //crud-----------
    public function add(){

        //add mechanism for checking meta
        $request = new Request();
        $recv_fields = json_decode(json_encode($request->post),true);
        $recv_fields = array_splice($recv_fields, 1);

        // print_r($request);
        if($request->server->request_method == "POST" && count($recv_fields) < 1){
            Response::error_response("No fields recieved on add request");
        } else if($request->server->request_method == "POST"){
            //check for duplicates
            if(count($recv_fields) >= count($this->meta->required_fields)){
                //check for duplicates\
                $no_duplicates = false;
                foreach($this->data as $row){
                    $user_id = $row[rtrim($this->model_name,"s") . '_id'];
                    unset($row[rtrim($this->model_name,"s") . '_id']);
                    if($row == $recv_fields){
                        $row['user_id'] = $user_id;
                        Response::json_response([
                                "status" => 1,
                                "status_msg" => "User already existed",
                                "user" => $row
                            ]);
                        exit();
                    } else {
                        $no_duplicates = true;
                    }
                }
                if($no_duplicates){
                    $id = $this->database->insert($this->model_name, json_decode(json_encode($request->post),true))->insert_id;
                    if($id){
                        Response::json_response([
                                "status_msg" => ucwords(rtrim($this->model_name, "s")) . " added!",
                                rtrim($this->model_name, "s") . "_id" => $id
                            ]);
                    } else {
                        Response::error_response("Failed to add " . ucwords(rtrim($this->model_name,"s")));
                    }
                }
            } else {
                $fields = array_diff($this->meta->required_fields, array_keys($recv_fields));
                Response::error_response("Total number required fields are not met. The required fields that aren't supplied are " . implode(", ", $fields));
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
    public function delete($key){
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