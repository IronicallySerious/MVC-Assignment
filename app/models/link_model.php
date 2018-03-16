<?php

namespace Models;

// Deals with link storage and display 
class LinkModel{

	// Returns all links that ever got posted in the website
	public static function all()
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("SELECT * FROM Links");
		$stmt->execute();

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		return $rows;
	}

	// Runs an INSERT command that inserts a link into the database
	public static function insert($title, $url, $username, $tags)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare(
			"INSERT INTO Links(title,url,username,tags)
				VALUES(?,?,?,?)"
		);
		$stmt->execute([$title,$url,$username,$tags]);
		$stmt = null;

		return;
	}

	// Runs a SELECT query that selects display-compatible columns of links of a specific id from the database
	public static function find($id)
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Prepare and send a SQL query
		$stmt = $db->prepare("SELECT title,username,url FROM Links WHERE id=?");
		$stmt->execute([$id]);

		// Collect results
		$rows = $stmt->fetch(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}
}