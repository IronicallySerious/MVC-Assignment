<?php

namespace Models;

// Deals with displaying, inserting and handling comments
class CommentModel{

//
// ─── MEMBER FUNCTIONS ────────────────────────────────────────────────────────────
//

	// Finds a comment that matches a particular linkid
	public static function find($linkid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("SELECT content,username,posttime FROM Comments WHERE linkid=?");	// TODO: Add support for user profiles and user specific data
		$stmt->execute([$linkid]);

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		// Increment the click count
		\Models\LinkModel::setClickCount($linkid);

		return $rows;
	}

	// Insert the contents of a comment into the Comments table
	public static function insert($content, $linkid, $uid, $username)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("INSERT INTO Comments(content,linkid,`uid`,`username`)
								VALUES(?,?,?,?)");
		$stmt->execute([$content,$linkid,$uid, $username]);
		$stmt = null;

		return;
	}

	// Records a comment upvote in the CommentUpvotes table
	public static function insertCommentUpvote($username, $linkid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("INSERT INTO CommentUpvotes(`username`,`lid`,`upvotetime`)
								VALUES(?,?,DEFAULT)");
		$stmt->execute([$username, $linkid]);
		$stmt = null;

		return;
	}

	// Returns the results of a select query that sorts all comment data according to the parameter sent in
	public static function findAndSortByParameter($linkid, $sortParameter)
	{
		$db = \DB::get_instance();

		if($sortParameter == "Chronology")
		{
			// Set query to sort by time of sharing
			$stmt = $db->prepare("SELECT * FROM Links 
									WHERE linkid=?
									ORDER BY sharetime DESC");
	
		}
		elseif($sortParameter == "Upvotes")
		{
			// Set query to sort by numbers of upvotes
			$stmt = $db->prepare("SELECT * FROM Links 
									WHERE linkid=?
									ORDER BY upvotes DESC");
		}
		else
		// Just to be sure...
		{
			return false;
		}

		// Execute the query prepared above
		$stmt->execute([$linkid]);

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		// Increment the click count
		\Models\LinkModel::setClickCount($linkid);

		return $rows;

	}
}