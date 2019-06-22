<?php

class ProductModel extends Model {

	public static function add($name,$description,$price,$user_id){
		$SQL = "INSERT INTO product(`name`,`description`,`price`,`user_id`)VALUES(?,?,?,?);";
		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute([$name,$description,$price,$user_id]);
		if($res){
			return DataBase::getInstance()->lastInsertId();
		}else{
			return $res;
		}
	}
}