<?php

class AdminModelController extends Controller {
	
	public function index(){
		$models = ModelModel::getAll();
		
		$this->set('models', $models);
	}
	
	public function add(){
		$this->set('brands', BrandModel::getAll());
		
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'name');
		
		$data = [
			'brand_id' => $brand_id,
			'name' => $name
		];
		
		$model_id = ModelModel::add($data);
		
		if($model_id){
			Session::set('addmodel', 'Model Added Successfully.');
			Misc::redirect('admin/models');
		}else{
			$this->set('message','Doslo je do greske prilikom dodavanja modela.');
		}
	}
	
	public function edit($id){
		$this->set('brands', BrandModel::getAll());
		
		$model = ModelModel::getById($id);
		
		if(!$model){
			Misc::redirect('admin/models');
		}
		$this->set('model', $model);
		
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$name = filter_input(INPUT_POST, 'name');
		$brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_NUMBER_INT);
		
		$data = ['name' => $name, 'brand_id' => $brand_id];
		
		$res = ModelModel::edit($id, $data);
		
		if($res){
			Session::set('editmodel', 'Model Edited Successfully.');
			Misc::redirect('admin/models');
		}else{
			$this->set('message', 'Doslo je do greske prilikom editovanja modela.');
		}
	}
	
}