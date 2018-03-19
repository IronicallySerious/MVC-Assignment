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
			self::$instance = new PDO("mysql:host=localhost;dbname=mvc;", 'root', '123');
		    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		return self::$instance;
	}
}