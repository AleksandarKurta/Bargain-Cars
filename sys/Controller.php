<?php

abstract class Controller {
	
	private $podaci = [];
	
	public function set($name, $value){
		if(preg_match('/^[A-z0-9_]+$/',$name)){
			$this->podaci[$name] = $value;
		}
	}
	
	public function getData(){
		return $this->podaci;
	}
	
	public function index(){
		
	}
	
	public function __pre(){
		
	}
	
	public function checkUserRole(){
		if(Session::get('role') === NULL || Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
		}
	}
}