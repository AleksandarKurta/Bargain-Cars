<?php

class ImageModel extends Model{
	
	public static function getImageByCarId($car_id){
        $SQL = "SELECT * FROM image WHERE car_id = ?;";
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$car_id]);
        if($res){
            return $prep->fetchAll(PDO::FETCH_OBJ);	
        }else{
            return [];
        }
    }
	
}