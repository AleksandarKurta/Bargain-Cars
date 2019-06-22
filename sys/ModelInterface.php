<?php

interface ModelInterface {
	
	public static function getAll();
	
	public static function getById($id);
	
	public static function add(array $data);
	
}