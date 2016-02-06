<?php

class Quiz extends Controller{
	public function __construct(){
    	parent::__construct();
    	$this->decimate();
	}
    public function index(){
        // Response::json_response($this->request->get);
        Response::json_response(["quiz_sets" => $this->get_quiz() ]); 
    }
    public function edit(){
    	print_r($this->request);

    }
    private function decimate(){
    	$action = explode("/", $this->request->get->action);
    	$this->{'quiz_id'} = (count($action) > 1) ? $action['1'] : "";
    	$this->{'action'} = (count($action) > 2) ? $action['2'] : "";
    }
    private function get_quiz(){
    	$_quiz = [];
    	$quizes = $this->db->select("quizes","*");
    	foreach($quizes as $k=>$quiz){
    		$_quiz[$k]['quiz_set'] = $quiz['quiz_set'];
    		$_quiz[$k]['quiz_id'] = $quiz['quiz_id'];
    		$_quiz[$k]['questions'] = [];
    		$questions = $this->db->query("SELECT * FROM questions WHERE quiz_id='" . $quiz['quiz_id'] . "'");
    		foreach($questions as $key=>$question){
    			unset($question['quiz_id']);
    			unset($question['question_timestamp']);
    			unset($question['question_timestamp']);

    			$_quiz[$k]['questions'][$key] = $question;
    			$_quiz[$k]['questions'][$key]['answer_id'] = $question['option_id'];

    			unset($question['option_id']);
    			$options = $this->db->query("SELECT * FROM options WHERE question_id='" . $question['question_id'] . "'");
    			foreach($options as $option){
    				
    				unset($option['question_id']);

    				$_quiz[$k]['questions'][$key]['options'][] = $option;
	    				    			
    			}
    		}
    	}
    	return $_quiz;
    }
}