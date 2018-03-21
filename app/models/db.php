<?php

/* 
	Global class that comprises of a function that sets up a PDO connection to the database.
	Used to obtain a PDO database instance while running SQL commands through PHP
*/
class DB{

//
// ─── MEMBER VARIABLES ───────────────────────────────────────────────────────────
//
	
	private static $instance;


//
// ─── MEMBER FUNCTIONS ───────────────────────────────────────────────────────────
//

	// Returns a database instance variable that initiates PDO with PHP
	public static function get_instance()
	{
		if(!self::$instance)
		{
			include __DIR__ .'/../../config/config.php';

			$str = "mysql:host=" . $config["host"] . ";dbname=mvc;";
			self::$instance = new PDO($str, $config["username"], $config["password"]);
		    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		return self::$instance;
	}
}