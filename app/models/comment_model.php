<?php

namespace Models;

// Deals with displaying, inserting and handling comments
class CommentModel{

	// Finds a comment that matches a particular linkid
	public static function find($linkid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("SELECT content FROM Comments WHERE linkid=?");	// TODO: Add support for user profiles and user specific data
		$stmt->execute([$linkid]);

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		return $rows;
	}

	public static function insert($content,$linkid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("INSERT INTO Comments(content,linkid)
								VALUES(?,?)");
		$stmt->execute([$content,$linkid]);
		$stmt = null;

		return;
	}
}