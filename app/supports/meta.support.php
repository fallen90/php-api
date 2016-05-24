<?php
class Meta {
    public $meta;
    public $required_fields;
    public $fields;
    public function __construct($table_name){
        //read meta.json
       try {
            $file = ".meta" . "/" . $table_name . ".meta.json";
            if(file_exists($file)){
                $json_meta = file_get_contents($file);
                $this->meta = json_decode($json_meta, true);
                $this->get_required_fields();
                $this->get_fields();
            } else {
                throw new Exception(ucwords($table_name) . "'s entity definition can't be found.", 1);
            }
        } catch (Exception $ex) {
            Response::error_response($ex->getMessage());
        }
    }

    private function get_required_fields(){
        if($this->meta != null){
            $rqflds = [];
            foreach($this->meta as $m){
                if($m['required']){
                    $rqflds[] = $m['column_name'];
                }
            }
            $this->required_fields = $rqflds;
        }
    }
    private function get_fields(){
        if($this->meta != null){
            $flds = [];
            foreach($this->meta as $m){
                $flds[] = $m['column_name'];
            }
            $this->fields = $flds;
        }
    }
    public function remove_extra($ar){
        //arr_diff = diff of arr1 to others
        $r = [];
        if($this->meta != null){
            foreach($ar as $key=>$value){
                if(in_array($key, $this->fields)){
                    $r[$key] = $value;
                }
            }
        }
        return $r;
    }
}