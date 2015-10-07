<?php
//handles request
    class Handler {
        public function __construct(){

        }
        public function getInstance(){
            return $this;
        }
        public function index(){
            $this->hello_world();
        }

        public function info(){
            Response::json_response([
                    'APP_VERSION' => APP_VERSION,
                    'APP_REVISION' => APP_REVISION,
                    'APP_AUTHOR' => APP_AUTHOR,
                    'APP_EMAIL' => APP_EMAIL,
                    'SITE_TITLE' => SITE_TITLE,
                    'SITE_LOGO' => SITE_LOGO,
                    'SITE_LOGO_MINI' => 'SITE_LOGO_MINI'
                ]);
        }
        public function hello_world(){
            Response::json_response([
                    'Hello World' => 'Hello_WORL_'
                ]);
        }
    }