<?php

class AdminBrandController extends Controller {
	
	public function index(){
		$brands = BrandModel::getAll();
		
		$this->set('brands',$brands);
	}
	
	public function add(){
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$name = filter_input(INPUT_POST, 'name');
		
		$data = ['name' => $name];
		
		$brand_id = BrandModel::add($data);
		
		if($brand_id){
			Session::set('addbrand', 'Brand Added Successfully.');
			Misc::redirect('admin/brands/');
		}else{
			$this->set('message', 'Doslo je do greske prilikom dodavanja brenda');
			return;
		}
	}
	
	public function edit($id){
		$brand = BrandModel::getById($id);
		
		if(!$brand){
			Misc::redirect('admin/brands');
		}
		
		$this->set('brand',$brand);
		
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$name = filter_input(INPUT_POST, 'name');
		
		$data = ['name' => $name];
		
		$res = BrandModel::edit($id, $data);
		
		if($res){
			Session::set('editbrand', 'Brand Edited Successfully.');
			Misc::redirect('admin/brands');
		}else{
			$this->set('message', 'Doslo je do greske prilikom izmene brenda');
			return;
		}
	}

}