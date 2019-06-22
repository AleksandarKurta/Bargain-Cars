<?php

class UserModel extends Model{
	
	public static function getActiveUserByUsernameAndPasswordHash($userName, $passwordHash){
        $SQL = 'SELECT * FROM user WHERE username = ? AND password = ? AND is_active = 1;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute([$userName, $passwordHash]);
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllUsernames(){
        $SQL = 'SELECT user_id, username FROM user';
        $prep = DataBase::getInstance()->prepare($SQL);
        $prep->execute();
        return $prep->fetchAll(PDO::FETCH_OBJ);
    }
}
