<?php
class Compression extends Handler {
    public function __construct(){
        parent::__construct();
        ob_start("ob_gzhandler");
        ob_start([$this,"sanitize_output"]);
        header("X-Compressed : True");
    }
    public function sanitize_output($buffer) {
      $search = ['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s','/<!--(.|\s)*?-->/'];
      $replace = ['>', '<', '\\1',''];
      $buffer = preg_replace($search, $replace, $buffer);
      return $buffer;
    } 
}