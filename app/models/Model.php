<?php

abstract class Model implements ModelInterface {
		
	protected final static function getTableName(){
		$className = get_called_class();
		$underscoredName = preg_replace('/([A-Z])/', '_$0' , $className);
		$loweCaseName = strtolower($underscoredName);
		return substr($loweCaseName, 1, -6);
	}
		
	public static function getAll(){
		$tableName = self::getTableName();
		$SQL = 'SELECT * FROM ' . $tableName . ';';
		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute();
		if($res){
			return $prep->fetchAll(PDO::FETCH_OBJ);	
		}else{
			return [];
		}
	}
	
	public static function getById($id){
		$tableName = self::getTableName();
		$SQL = 'SELECT * FROM ' . $tableName . ' WHERE '  . $tableName . '_id = ?;';
		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute([$id]);
		if($res){
			return $prep->fetch(PDO::FETCH_OBJ);	
		}else{
			return null;
		}
	}
	
	public static function add(array $data){
		$tableName = self::getTableName();
		$nizImenaPolja   = [];
		$nizPlaceholdera = [];
		$nizVrednosti    = [];
		
		foreach($data as $imePolja => $vrednostPolja){
			if(preg_match('/^[a-z][a-z0-9\_]*$/',$imePolja) and $imePolja != $tableName . '_id'){
				if(is_object($vrednostPolja) or is_array($vrednostPolja)){
					continue;
				}
				
				$nizImenaPolja[] = $imePolja;
				$nizPlaceholdera[] = '?';
				$nizVrednosti[] = $vrednostPolja;
			}
		}
		
		$spisakPolja = implode(', ', $nizImenaPolja);
		$spisakUpitnika = implode(', ', $nizPlaceholdera);
		
		$SQL = 'INSERT INTO ' . $tableName . '(' . $spisakPolja . ') VALUES (' . $spisakUpitnika . ');';
		
		$prep = DataBase::getInstance()->prepare($SQL);
		if($prep){
			$res = $prep->execute($nizVrednosti);
			if($res){
				return DataBase::getInstance()->lastInsertId();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public static function edit($id, array $data){
		$tableName = self::getTableName();
		$nizPromena = [];
		$nizVrednosti = [];
		
		foreach($data as $imePolja => $vrednostPolja){
			if(preg_match('/^[a-z][a-z0-9\_]*$/',$imePolja) and $imePolja != $tableName . '_id'){
				if(is_object($vrednostPolja) or is_array($vrednostPolja)){
					continue;
				}
					$nizPromena[] = $imePolja . ' = ? ';
					$nizVrednosti[] = $vrednostPolja;
			}
		}
		
		$spisakPromena = implode(', ', $nizPromena);
		$spisakVrednosti = implode(', ', $nizVrednosti);
		
		$SQL = 'UPDATE ' . $tableName . ' SET ' . $spisakPromena . ' WHERE ' . $tableName . '_id = ?;';

		$prep = DataBase::getInstance()->prepare($SQL);
		if($prep){
			$nizVrednosti[] = $id;
			return $prep->execute($nizVrednosti);
		}else{
			return false;
		}
	}

	public static function getByFieldName(string $fieldName, $value){
		$tableName = self::getTableName();
		$SQL = 'SELECT * FROM ' . $tableName . ' WHERE ' . $fieldName . ' = ?;';

		$prep = DataBase::getInstance()->prepare($SQL);
		$res = $prep->execute([$value]);
		$item = NULL;
		if($res){
			$item = $prep->fetch(\PDO::FETCH_OBJ);
		}
		return $item;
	}

}