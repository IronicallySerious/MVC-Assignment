<?php

namespace Models;

// Deals with link storage and display 
class LinkModel{

//
// ─── MEMBER FUNCTIONS ────────────────────────────────────────────────────────────
//

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
			"INSERT INTO Links(title,`url`,username,clicks,sharetime)
				VALUES(?,?,?,?,DEFAULT)"
		);
		$stmt->execute([$title,$url,\Models\UserModel::getUsername(),0]);
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

	/* 
		Returns result set of trending links in descending order of trendiness
		The trendiness of a link has been decided to be dependent on the sum of clicks and upvotes and the age
		that a link gets, instead of just ratio of upvotes to clicks or age of the post

		Because if just the ratio is applied:

		1. A year old post that got millions or billions of likes won't be considered as trending

		2. A post that got to the trending page too high will most likely be there for a very long time
			even when another post that recently got a lot of likes (that doesn't appear in the trending links page) will not be displayed.
		
		3. A post that has clickbait stuff on it will wrongly rise up. If we use sum of clicks and views, then such
			links will not acquire any clicks, and the sum of clicks to views will slowly be overshadowed by other 
			links that are performing well.
	*/
	public static function getTrendingLinks()
	{
		// Update upvote counts in Links table
		self::setUpdateUpvoteCount();

		// Update the traffic count
		self::setUpdateClickCount();

		// Init a link to the db
		$db = \DB::get_instance();

		// Prepare and send a SQL query
		$stmt = $db->prepare("SELECT * FROM Links
								ORDER BY traffic DESC");
		$stmt->execute();

		// Collect results
		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}

	// Updates the link upvote count
	public static function setUpdateUpvoteCount()
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Update the link upvote count
		$stmt = $db->prepare("UPDATE `Links`
								SET `upvotes`= (SELECT count(*) FROM Upvotes
												WHERE Upvotes.lid = id AND Upvotes.type = 1)");
		$stmt->execute();

		// Security purposes
		$stmt = NULL;

		return;
	}

	// Update the click count
	public static function setUpdateClickCount()
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Update the traffic count
		$stmt = $db->prepare("UPDATE `Links`
								SET `traffic`= clicks + upvotes");
		$stmt->execute();

		// Security purposes
		$stmt = NULL;

		return;
	}

	// TODO: Add comment and definition
	public static function insertTags($tags, $linkid)
	{

	}

	// Returns links under a particular username
	public static function getLinksByAUser($username)
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Prepare and send a SQL query
		$stmt = $db->prepare("SELECT * FROM Links 
								WHERE username = ?
								ORDER BY sharetime DESC");
		$stmt->execute([$username]);

		// Collect results
		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}

	// Returns links under a particular uid
	public static function getLinksByAUserID($uid)
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Acquire username from uid
		$username = \Models\UserModel::getUserDetailByUserId($uid, "username");

		// Prepare and send a SQL query
		$stmt = $db->prepare("SELECT * FROM Links 
								WHERE username = ?
								ORDER BY sharetime DESC");
		$stmt->execute([$username]);

		// Collect results
		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}

	/* 
		Returns the top links of the database
		based on descending oder of number of clicks
	*/
	public static function getTopLinks()
	{
		// Init a link to the db
		$db = \DB::get_instance();

		// Prepare and send a SQL query tat selects all link details
		// in descending order of number of clicks
		$stmt = $db->prepare("SELECT * FROM Links
								ORDER BY clicks DESC");
		$stmt->execute([$username]);

		// Collect results
		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

		// Ship
		return $rows;
	}
}