<?php

class AdminCheckboxController extends Controller {
	
	public function index(){
		$checkboxes = CheckboxModel::getAll();
		
		$this->set('checkboxes', $checkboxes);
	}
	
	public function add(){
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$name = filter_input(INPUT_POST, 'name');
		
		$data = ['name' => $name];
		
		$checkbox_id = CheckboxModel::add($data);
		
		if($checkbox_id){
			Misc::redirect('admin/checkboxes/');
		}else{
			$this->set('message','Doslo je do greske prilikom dodavanja checkboxa');
		}
	}
	
	public function edit($id){
		$checkbox = CheckboxModel::getById($id);
		
		if(!$checkbox){
			Misc::redirect('admin/checkboxes/');
		}else{
			$this->set('checkbox',$checkbox);
		}
		
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$name = filter_input(INPUT_POST, 'name');
		
		$data = ['name' => $name];
		
		$res = CheckboxModel::edit($id, $data);
		
		if($res){
			Misc::redirect('admin/checkboxes/');
		}else{
			$this->set('message','Doslo je do greske prilikom editovanja checkboxa');
		}
		
	}
	
}