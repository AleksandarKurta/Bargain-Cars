<?php

class AdminCarsController extends Controller{
	
	public function index(){
		$brand_ids = BrandModel::getAll();
		$model_ids = ModelModel::getAll();
		
		$cars = CarModel::getAll();
		
		$brands = []; 
		foreach($brand_ids as $brand){
			$brands[$brand->brand_id] = $brand->name; 
		}
		
		$models = [];
		foreach($model_ids as $model){
			$models[$model->model_id] = $model->name;
		}

		$this->set('brands', $brands);
		$this->set('models', $models);
		$this->set('cars', $cars);
	}
	
	public function add(){
		$this->set('brands', BrandModel::getAll());
		$this->set('models', ModelModel::getAll());
		$this->set('checkboxes', CheckboxModel::getAll());
		$this->set('locations', LocationModel::getAll());
		
		if(!$_FILES) return;
		if(!isset($_FILES['main_image'])) return;
		$this->checkUserRole();
		
		if($_FILES['main_image']['error'] != 0){
			$this->set('message','Doslo je do greske prilikom dodavanja fajla!');
			return;
		}
		
		$temporaryPath = $_FILES['main_image']['tmp_name'];
		$fileSize = $_FILES['main_image']['size'];
		$originalName = $_FILES['main_image']['name'];
		
		if($fileSize > 300 * 1024){
			$this->set('message','Fajl koji dodajtete je veci od maksimalne dozvoljene velicine 300KB!');
			return;
		}
		
		$imageFileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ){
			$this->set('message','Dozvoljeno je dodavanje jpg, png, jpeg i gif formata slika!');
			return;
		}
		
		$newLocation = Configuration::IMAGE_DATA_PATH . basename($originalName);
		
		$res = move_uploaded_file($temporaryPath, $newLocation);
		if(!$res){
			$this->set('message', 'Doslo je do greske prilikom cuvanja fajla na krajnju lokaciju. Nemate privilegija za upis u ovaj direktorijum!');
			return;
		}
		
		$brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_NUMBER_INT);
		$model_id = filter_input(INPUT_POST, 'model_id', FILTER_SANITIZE_NUMBER_INT);
		$year = filter_input(INPUT_POST, 'year');
		$price = filter_input(INPUT_POST, 'price');
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
		$location_id = filter_input(INPUT_POST, 'location_id');
		$date = date('d.m.Y');
		
		$data = [
			"brand_id" => $brand_id,
			"model_id" => $model_id,
			"year" => $year,
			"price" => $price,
			"description" => $description,
			"user_id" => Session::get('user_id'),
			"main_image" => $newLocation,
			"date" => $date,
			"location_id" => $location_id
		];
		
	
		$car_id = CarModel::add($data);
		
		if($car_id){
			$checkbox_ids = filter_input(INPUT_POST, 'checkbox_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
			foreach($checkbox_ids as $checkbox_id){
				CarModel::addCheckboxToCar($car_id, $checkbox_id);
			}
			Session::set('addcar', 'Car Added Successfully.');
			Misc::redirect('admin/cars/');
		}else{
			$this->set('message', 'Neuspesan unos automobila.');
			return;
		}
	}
	
	public function edit($id){
		$this->set('brands', BrandModel::getAll());
		$this->set('models', ModelModel::getAll());
		$this->set('locations', LocationModel::getAll());
		$this->set('checkboxes', CheckboxModel::getAll());
		
		$car = CarModel::getById($id);
		
		if(!$car){
			Misc::redirect('admin/cars/');
		}
		
		$car->checkboxes = CarModel::getCheckboxesForCarId($id);
		$car->checkbox_ids = [];
		foreach($car->checkboxes as $tag){
			$car->checkbox_ids[] = $tag->checkbox_id;
		}
		
		$this->set('car', $car);
		
		if(!$_POST) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		$brand_id = filter_input(INPUT_POST, 'brand_id', FILTER_SANITIZE_NUMBER_INT);
		$model_id = filter_input(INPUT_POST, 'model_id', FILTER_SANITIZE_NUMBER_INT);
		$year = filter_input(INPUT_POST, 'year');
		$price = filter_input(INPUT_POST, 'price');
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
		$location_id = filter_input(INPUT_POST, 'location_id');
		$date = date('d.m.Y');
		
		$data = [
			"brand_id" => $brand_id,
			"model_id" => $model_id,
			"year" => $year,
			"price" => $price,
			"description" => $description,
			"user_id" => Session::get('user_id'),
			"date" => $date,
			"location_id" => $location_id
		];
		
		$res = CarModel::edit($id, $data);
		
		$checkbox_ids = filter_input(INPUT_POST, 'checkbox_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
		
		CarModel::deleteAllCheckboxes($id);
		foreach($checkbox_ids as $checkbox_id){
			CarModel::addCheckboxToCar($id, $checkbox_id);
		}
		
		if($res){
			Session::set('editcar', 'Car Edited Successfully.');
			Misc::redirect('admin/cars/');
		}else{
			$this->set('message', 'Greska prilikom izmene automobila.');
			return;
		}
		
		
	}
	
	
}