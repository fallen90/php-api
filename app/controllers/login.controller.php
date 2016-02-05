<?php

class Login extends Controller {
	public function __construct(){
    	parent::__construct();
	}
    public function index(){
        Response::json_response($this->request->get);
    }   
}