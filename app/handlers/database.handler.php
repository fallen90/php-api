<?php
class Database extends Handler {
    private $conn;
    
    public $insert_id = "";

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $link = new mysqli(HOST, USER, PASS, DB);
        if (!$link->connect_errno) {
            $this->conn = $link;
        } else {
            return false;
        }
    }
    public function __destruct(){
        mysqli_close($this->conn);
    }
    public function getInstance(){
        return $this->conn;
    }

    public function query($sql)
    {
        $result = $this->conn->query($sql);
        if (!$this->conn->connect_errno) {
            return $result;
        } else {
            return false;
        }
    }
    public function insert($table, $values, $where = "")
    {
        $fields = "(`" . implode("`,`", array_keys($values)) . "`)";
        $values = "('" . implode("','", array_values($values)) . "')";
        $sql = "INSERT INTO `$table` $fields VALUES $values $where";
        $this->query($sql);
        $this->insert_id = mysqli_insert_id($this->conn);
        return $this;
    }
    public function delete($table, $col_ref, $col_val){
        $sql ="DELETE FROM `$table` WHERE `$col_ref`='$col_val'";
        $this->query($sql);
    }
    public function update($table, $values, $where=""){
        $update_fields = [];
        foreach($values as $key=>$value){
            $update_fields[] = "`$key` = '$value'";
        }
        $sql = "UPDATE `$table` SET " . implode(", ", $update_fields) . " $where";
        $this->query($sql);
    }
    public function select($table, $fields, $where = "", $multiple = true)
    {
        if($fields != "*"){
            $fields = "`" . implode("`,`",$fields) . "`";
        }

        $sql = "SELECT " . $fields . " FROM $table $where";
        if($multiple){
            $data = [];
            foreach ($this->query($sql) as $value) {
                $data[] = $value;
            }
            return $data;
        } else {
            return $this->query($sql)->fetch_assoc();
        }
    }
    public function show_columns($table){
        $columns = [];
        $q = $this->query("SHOW COLUMNS FROM $table");
        if($q != null){
            foreach($q as $column){
                $columns[] = $column;
            }
        }
        return $columns;
    }
}