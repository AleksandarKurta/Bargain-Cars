<?php

class DataBase {
	
	private static $db = NULL;
	
	public static function getInstance(){
		if(static::$db == NULL){											# Konektovanje se izvrsava samo jednom
			static::$db = new PDO('mysql:host=' . Configuration::DB_HOST .  # Adresa servera
								  ';dbname='    . Configuration::DB_NAME .  # Ime baze podataka
								  ';charser=utf8',							# Unikodna podrska
								  Configuration::DB_USER,					# Korisnik za bazu
								  Configuration::DB_PASS,					# Lozinka tog korisnika
								  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));		# Unikodna podrska za specijalne karaktere		
			static::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	# Ne zelimo da server testira izraze
		}
		return static::$db; # Vracamo primerak konekcije na bazu podatala
	}
	
}