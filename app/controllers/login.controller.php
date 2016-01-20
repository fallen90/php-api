<?php

class Login extends Api {
    public function index(){
        Response::json_response($request->get);
    }   
}