<?php

class Login extends Api {
    public function __construct(){}
    public function index(){
        Response::json_response($requests->get);
    }   
}