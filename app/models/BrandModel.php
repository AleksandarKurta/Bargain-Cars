<?php

class BrandModel extends Model{

    public static function getByKeyword($keyword){
        $SQL = "SELECT * FROM brand WHERE `name` LIKE ?";
        $prep = DataBase::getInstance()->prepare($SQL);
        $string = '%' . trim($keyword) . '%';
        $prep->execute([$string]);
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
}