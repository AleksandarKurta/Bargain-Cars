<?php

class Misc {
	
	public static function link($url){
		return Configuration::BASE_URL . $url;
	}
	
	public static function url($url, $title){
		echo '<a href="' . Configuration::BASE_URL . $url . '">' . htmlspecialchars($title) .'</a>'; 
	}
	
	public static function redirect($url){
		ob_clean();
		header('Location: ' . Configuration::BASE_URL . $url );
		exit;
	}
	
}