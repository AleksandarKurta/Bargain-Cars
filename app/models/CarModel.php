<?php

class CarModel extends Model{
	
	public static function addCheckboxToCar($car_id, $checkbox_id){
		$SQL = 'INSERT INTO car_checkbox(car_id, checkbox_id) VALUES (?, ?);';
		$prep = DataBase::getInstance()->prepare($SQL);
		return $prep->execute([$car_id, $checkbox_id]);
	}
	
	public static function getCheckboxesForCarId($car_id){
		$SQL = 'SELECT * FROM car_checkbox WHERE car_id = ?';
		$prep = DataBase::getInstance()->prepare($SQL);
		$prep->execute([$car_id]);
		$spisak = $prep->fetchAll(PDO::FETCH_OBJ);
		$list = [];
		foreach($spisak as $item){
			$list[] = CheckboxModel::getById($item->checkbox_id);
		}
		return $list;
	}
	
	public static function deleteAllCheckboxes($car_id){
		$SQL = 'DELETE FROM car_checkbox WHERE car_id = ?;';
		$prep = DataBase::getInstance()->prepare($SQL);
		return $prep->execute([$car_id]);
	}

	public static function getCarImages($car_id){
		$SQL = 'SELECT * FROM image WHERE car_id = ?';
		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute([$car_id]);
		if($res){
			return $prep->fetchAll(PDO::FETCH_OBJ);
		}else{
			return [];
		}
	}
	
	public static function search($brand_id, $model_id, $year_from, $year_to, $price_from, $price_to, $location_id, $checkbox_ids, $startFrom, $perPage){
		$numOfIds = count($checkbox_ids);
		$checkbox_placeholder = [];
		for($i=0;$i<$numOfIds;$i++){
			$checkbox_placeholder[] = '?';
		}
		$checkbox_placeholder_string = implode(', ',$checkbox_placeholder);
		
		$SQL = "SELECT car.*, brand.`name` AS brand_name, model.name AS model_name, `location`.`name` AS location_name
				FROM
					car
				INNER JOIN brand ON car.brand_id = brand.brand_id
				INNER JOIN model ON car.model_id = model.model_id
				INNER JOIN location ON car.location_id = `location`.location_id
				WHERE (car.brand_id = ? OR ? = -1) AND (car.model_id = ? OR ? = -1)
				AND ( ? < car.year OR ? = -1) AND ( ? > car.year OR ?  = -1)
				AND ( ?  < car.price OR ?  = '') AND ( ?  > car.price OR ?  = '') 
				AND (car.location_id = ? OR ? = -1)
				" . ($numOfIds > 0 ? " AND car.car_id IN (
				SELECT car.car_id FROM car JOIN car_checkbox ON 
					car_checkbox.car_id = car.car_id 
				WHERE car_checkbox.checkbox_id IN ({$checkbox_placeholder_string})
				GROUP BY car.car_id HAVING COUNT(car.car_id) = ?
				)LIMIT $startFrom, $perPage;":"LIMIT $startFrom, $perPage;");	
				
		$prep = DataBase::getInstance()->prepare($SQL);
		$arr = [$brand_id,$brand_id, $model_id, $model_id, $year_from, $year_from, $year_to, $year_to, $price_from, $price_from, $price_to, $price_to, $location_id, $location_id];
		if($numOfIds > 0){
			$arr = array_merge($arr, $checkbox_ids); 
			$arr[] = $numOfIds;
		}
	
		$prep->execute($arr);
		
		return $prep->fetchAll(PDO::FETCH_OBJ);
	}

	public static function getNumerOfResults($brand_id, $model_id, $year_from, $year_to, $price_from, $price_to,$location_id, $checkbox_ids){
		$numOfIds = count($checkbox_ids);
		$checkbox_placeholder = [];
		for($i=0;$i<$numOfIds;$i++){
			$checkbox_placeholder[] = '?';
		}
		$checkbox_placeholder_string = implode(', ',$checkbox_placeholder);
		
		$SQL = "SELECT car.*, brand.`name` AS brand_name, model.name AS model_name, `location`.`name` AS location_name
				FROM
					car
				INNER JOIN brand ON car.brand_id = brand.brand_id
				INNER JOIN model ON car.model_id = model.model_id
				INNER JOIN location ON car.location_id = `location`.location_id
				WHERE (car.brand_id = ? OR ? = -1) AND (car.model_id = ? OR ? = -1)
				AND ( ? < car.year OR ? = -1) AND ( ? > car.year OR ?  = -1)
				AND ( ?  < car.price OR ?  = '') AND ( ?  > car.price OR ?  = '') 
				AND (car.location_id = ? OR ? = -1)
				" . ($numOfIds > 0 ? " AND car.car_id IN (
				SELECT car.car_id FROM car JOIN car_checkbox ON 
					car_checkbox.car_id = car.car_id 
				WHERE car_checkbox.checkbox_id IN ({$checkbox_placeholder_string})
				GROUP BY car.car_id HAVING COUNT(car.car_id) = ?
				);":";");	
				
		$prep = DataBase::getInstance()->prepare($SQL);
		$arr = [$brand_id,$brand_id, $model_id, $model_id, $year_from, $year_from, $year_to, $year_to, $price_from, $price_from, $price_to, $price_to, $location_id, $location_id];
		if($numOfIds > 0){
			$arr = array_merge($arr, $checkbox_ids); 
			$arr[] = $numOfIds;
		}
	
		$prep->execute($arr);
		$count = $prep->rowCount();
		return $count;
	}

	public static function getCarsWithLimit(){
		$SQL = 'SELECT * FROM car LIMIT 8;';
		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute();
		if($res){
			return $prep->fetchAll(PDO::FETCH_OBJ);	
		}else{
			return [];
		}
	}
		
	
}