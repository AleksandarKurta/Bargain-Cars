<?php

class ApiCarsController extends ApiController {
    
    public function show($id){
        $carId = intval($id);
        $car = CarModel::getById($carId);

        if($car){
            $this->set('car', $car);
            $this->set('status', 'success');          
        }else{
            $this->set('status', 'error');  
            $this->set('message', 'Could not find the selected car.'); 
        }
    }

    public function brands(){
        $brands = BrandModel::getAll();
        
        if($brands){
            $this->set('brands', $brands);
            $this->set('status', 'success');          
        }else{
            $this->set('status', 'error');  
            $this->set('message', 'Could not find the selected brands.'); 
        }
    }

    public function brand($id){
        $brandId = intval($id);
        $brand = BrandModel::getById($brandId);

        if($brand){
            $this->set('brand', $brand);
            $this->set('status', 'success');
        }else{
            $this->set('status', 'error');  
            $this->set('message', 'Could not find the selected brand.'); 
        }
    }

    public function search($keyword){
        $brand = BrandModel::getByKeyword($keyword);

        if($brand){
            $this->set('brand', $brand);
            $this->set('status', 'success');
        }else{
            $this->set('status', 'error');  
            $this->set('message', 'Could not find the selected brand.'); 
        }
    }

    public function add(){
        if($_POST){
            if(!$_FILES) return;
            if(!isset($_FILES['main_image'])) return;
            
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
                "brand_id" => '3',
                "model_id" => '7',
                "year" => $year,
                "price" => $price,
                "description" => $description,
                "user_id" => Session::get('user_id'),
                "main_image" => $newLocation,
                "date" => "30.11.2018",
                "location_id" => "2"
            ];
            
        
            $car_id = CarModel::add($data);
            
            if($car_id){
                $checkbox_ids = filter_input(INPUT_POST, 'checkbox_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
                foreach($checkbox_ids as $checkbox_id){
                    CarModel::addCheckboxToCar($car_id, $checkbox_id);
                }
                
                $this->set("car_id",$car_id);
                $this->set("status","success");
            }else{
                $this->set("status","error");
            }
        }else{
            $this->set("message","Illegal function call.");
        }
    }
}