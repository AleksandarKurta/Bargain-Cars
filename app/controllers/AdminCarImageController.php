<?php

class AdminCarImageController extends Controller {

    public function listCarImage($car_id){
        $car = CarModel::getById($car_id);
        $car->brand = BrandModel::getById($car->brand_id);
        $car->model = ModelModel::getById($car->model_id);
        $this->set('images',ImageModel::getImageByCarId($car_id));
        $this->set('car', $car);
    }

	public function uploadImage($car_id){
        if(!$_FILES) return;
		if(!isset($_FILES['image'])) return;
		if(Session::get('role') !== 'admin'){
			$this->set('alert', 'You are not authorized!');
			return;
		}
		
		if($_FILES['image']['error'] != 0){
			$this->set('message','Doslo je do greske prilikom dodavanja fajla!');
			return;
		}
		
		$temporaryPath = $_FILES['image']['tmp_name'];
		$fileSize = $_FILES['image']['size'];
		$originalName = $_FILES['image']['name'];
		
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
			$this->set('message','Doslo je do greske prilikom cuvanja fajla na krajnju lokaciju. Nemate privilegija za upis u ovaj direktorijum!');
			return;
		}
		
		$data = [
			"path" => $newLocation,
			"car_id" => $car_id,
		];
		
		$res = ImageModel::add($data);
		if(!$res){
			$this->set('message','Doslo je do greske prilikom unosa u bazu podataka!');
			return;
		}else{
			Misc::redirect('admin/images/car/' . $car_id);
		}
	}

}