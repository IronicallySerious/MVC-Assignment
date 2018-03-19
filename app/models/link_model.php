<?php

namespace Models;

// Deals with link storage and display 
class LinkModel{

	// Returns all links that ever got posted in the website in descending order of time of posting
	public static function all()
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("SELECT * FROM Links
								ORDER BY sharetime DESC");
		$stmt->execute();

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		return $rows;
	}

	// Runs an INSERT command that inserts a link into the database
	public static function insert($title, $url, $username, $tags)
	{
		$db = \DB::get_instance();

		// Insert title, link url, username of OP and tags associated with it in the database
		$stmt = $db->prepare(
			"INSERT INTO Links(title,`url`,username,tags,clicks,sharetime)
				VALUES(?,?,?,?,?,DEFAULT)"
		);
		$stmt->execute([$title,$url,\Models\UserModel::getUsername(),$tags,0]);
		$stmt = null;

		return;
	}

	// Runs a SELECT query that selects display-compatible columns of links of a specific id from the database
	public static function find($id)
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Prepare and send a SQL query
		$stmt = $db->prepare("SELECT id,title,username,`url`,clicks 
								FROM Links 
								WHERE id=?");
		$stmt->execute([$id]);

		// Collect results
		$rows = $stmt->fetch(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}

	// Increments the click count by 1
	public static function setClickCount($linkid)
	{
		// Init a link to the db
		$db = \DB::get_instance();

		$stmt = $db->prepare("UPDATE Links
								SET clicks = clicks + 1
								WHERE id = ?");
		$stmt->execute([$linkid]);
	}
}