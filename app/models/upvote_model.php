<?php

namespace Models;

class UpvoteModel{

    // Returns the number of upvotes of a link
    public static function getUpvotes($linkid)
    {
        $db = \DB::get_instance();

        // Count the number of times the link appears in the Upvote table where the upvote type was +1 (-1 is set for downvotes)
		$stmt = $db->prepare("SELECT count(*) FROM Upvotes WHERE lid = ? AND `type` = 1");
		$stmt->execute([$linkid]);

		$row = $stmt->fetch(); // fetchAll() does <$stmt = null;> automatically

		return $row['count(*)'];
    }

    // Add an upvote
    public static function insertUpvote($linkid)
    {
        
    }

}