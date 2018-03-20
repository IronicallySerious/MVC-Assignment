<?php

namespace Models;

class UpvoteModel{

//
// ─── MEMBER FUNCTIONS ────────────────────────────────────────────────────────────
//

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

    // Adds an upvote of a type ($type = 1 for an upvote, $type = -1 for a downvote) of a user that saw the post
    public static function insertUpvote($linkid, $type, $uid)
    {
        $db = \DB::get_instance();

		// Insert title, link url, username of OP and tags associated with it in the database
		$stmt = $db->prepare("INSERT INTO `Upvotes`(`uid`, `lid`, `upvotetime`, `type`) 
                                VALUES (?,?,DEFAULT,?)"
		);
		$stmt->execute([$uid, $linkid, $type]);
		$stmt = null;

		return;
    }

    /*  Returns false when the user has upvoted a certain link
        else returns true if a result row is found
    */
    public static function hasUserUpvotedThisLink($linkid, $uid)
    {
        $row = self::getUpvoteDetails($linkid, $uid);

        // Return false if no results are found, else return true
        return ($row == false)? false: true;
    }

/*
    Returns 
        user id,
        link id,
        upvotetime,
        type of upvote (+1 for upvote, -1 for downvote) 
    for a specific upvote
*/
    public static function getUpvoteDetails($linkid, $uid)
    {
        $db = \DB::get_instance();

        // SELECTS details from Upvotes table for a specific upvote event
        // type is not checked to disallow both upvoting and downvoting
        $stmt = $db->prepare("SELECT * FROM Upvotes WHERE `uid` = ? AND lid = ?");
		$stmt->execute([$uid, $linkid]);

		$row = $stmt->fetch(); // fetchAll() does <$stmt = null;> automatically

		return $row;
    }

    public static function removeUpvote($linkid, $uid)
    {
        // Init a link to the db
		$db = \DB::get_instance();

		$stmt = $db->prepare("DELETE FROM `Upvotes` 
                                WHERE `uid` = ? AND `lid` = ? AND `type` = 1");
        $stmt->execute([$uid, $linkid]);
        
        return;
    }
}