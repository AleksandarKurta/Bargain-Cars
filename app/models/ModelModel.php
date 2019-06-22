<?php


class ModelModel extends Model{
	
	public static function getModelByBrandId($id){
        $SQL = "SELECT * FROM model WHERE brand_id = ?;";
        print_r([$id]);
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$id]);
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
	
}

