<?php

class MainController extends Controller {
	
	public function index(){
		$brands = BrandModel::getAll();
		$brand_ids = [];
		foreach($brands as $brand){
			$brand_ids[$brand->brand_id] = $brand->name;
		}

		$models = ModelModel::getAll();
		$model_ids = [];
		foreach($models as $model){
			$model_ids[$model->model_id] = $model->name;
		}
		$this->set('brand_ids', $brand_ids);
		$this->set('model_ids', $model_ids);
		$this->set('brands', $brands);
		$this->set('models', $models);
		$this->set('locations', LocationModel::getAll());
		$this->set('checkboxes', CheckboxModel::getAll());
		$this->set('posts', PostModel::getAll());
		$this->set('limitcars', CarModel::getCarsWithLimit());
	}
	
	public function search($page){
		$brand_id = filter_input(INPUT_GET, 'brand_id', FILTER_SANITIZE_NUMBER_INT);
		$model_id = -1;
		if(isset($_GET['model_id'])){
			$model_id = filter_input(INPUT_GET, 'model_id', FILTER_SANITIZE_NUMBER_INT);
		}
		$year_from = filter_input(INPUT_GET, 'year_from', FILTER_SANITIZE_NUMBER_INT);
		$year_to = filter_input(INPUT_GET, 'year_to', FILTER_SANITIZE_NUMBER_INT);
		
		$price_from = filter_input(INPUT_GET, 'price_from', FILTER_SANITIZE_NUMBER_INT);
		$price_to = filter_input(INPUT_GET, 'price_to', FILTER_SANITIZE_NUMBER_INT);
		$location_id = filter_input(INPUT_GET, 'location_id', FILTER_SANITIZE_NUMBER_INT);
		
		$checkbox_ids = filter_input(INPUT_GET, 'checkbox_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY); 
		
		$perPage = 5;
		$startFrom = ($page - 1) * $perPage;
	
		$cars = CarModel::search($brand_id, $model_id, $year_from, $year_to, $price_from, $price_to,$location_id, $checkbox_ids, $startFrom, $perPage);

		$numberOfResults = CarModel::getNumerOfResults($brand_id, $model_id, $year_from, $year_to, $price_from, $price_to,$location_id, $checkbox_ids);
		
		$numberOfPages = ceil($numberOfResults/$perPage);
		
		$this->set('numberOfPages', $numberOfPages);
		$this->set('page', $page);
		
		$this->set('brands', BrandModel::getAll());
		$this->set('models', ModelModel::getAll());
		$this->set('locations', LocationModel::getAll());
		$this->set('checkboxes', CheckboxModel::getAll());
	
		$this->set('cars', $cars);
		
		$this->set('brand_id', $brand_id);
		$this->set('model_id', $model_id);
		$this->set('year_from', $year_from);
		$this->set('year_to', $year_to);
		$this->set('price_from', $price_from);
		$this->set('price_to', $price_to);
		$this->set('location_id', $location_id);
		$this->set('checkbox_ids', $checkbox_ids);
		$this->set('posts', PostModel::getAll());
	}

	public function car($car_id){
		$car =  CarModel::getById($car_id);

		$car->brand = BrandModel::getById($car->brand_id);
		$car->model = ModelModel::getById($car->model_id);
		$car->images = CarModel::getCarImages($car->car_id);
		$car->location = LocationModel::getById($car->location_id);

		$this->set('car', $car);
	}

	public function register(){
		if(!$_POST) return;
			
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
		$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
		$userName = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
		$password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
		$password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

		if(empty($email) OR empty($firstName) OR empty($lastName) OR empty($userName) OR  empty($password1) OR empty($password2)){
			$this->set('warning','Fields must not be empty.');
			return;
		}

		if($password1 !== $password2){
			$this->set('warning','Passwords does not match.');
			return;
		}

		$user = UserModel::getByFieldName('email', $email);
		if($user){
			$this->set('warning','Email already exists.');
			return;
		}

		$user = UserModel::getByFieldName('username', $userName);
		if($user){
			$this->set('warning','Username already exists.');
			return;
		}

		if(strlen($password1) < 7){
			$this->set('warning','Password should have more than seven characters.');
			return;
		}
		
		$passwordHash = password_hash($password1, PASSWORD_DEFAULT);
		$data = [
			"email" => $email,
			"firstname" => $firstName,
			"lastname" => $lastName,
			"username" => $userName,
			"password" => $passwordHash,
		];

		$userId = UserModel::add($data);
		if(!$userId){
			$this->set('warning','Unable to register.');
			return;
		}
		
		$this->set('success','Registration successful , you can log in now.');
	}

	public function login(){
		if(!$_POST) return;

		$userName = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		if(empty($userName) OR empty($password)){
			$this->set('alert', 'Fields must not be empty');
			return;
		}

		$user = UserModel::getByFieldName('username', $userName);

		if(!$user){
			$this->set('alert', 'Error: Wrong username');
			return;
		}

		if(!password_verify($password, $user->password)){
			sleep(1);
			$this->set('alert', 'Error: Wrong password');
			return;
		}

		if($user){
			Session::set('user_id', $user->user_id);
			Session::set('username', $user->username);
			Session::set('role', $user->role);
			Session::set("user_ip",filter_input(INPUT_SERVER,"REMOTE_ADDR",FILTER_FLAG_IPV4));
			Session::set("user_agent",filter_input(INPUT_SERVER,"HTTP_USER_AGENT"));
			Misc::redirect('');
		}else{
			$this->set('alert', 'Username or Password are incorect.');
			return;
		}
	}

	public function logout(){
		Session::end();
		Misc::redirect('');
	}

}
