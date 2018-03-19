<?php

namespace Models;

class DownvoteModel{
    public static function hasUserDOWNVOTEDThisLink($linkid, $uid)
    {
        // Still checking upvote statistics because this function doesn't check for type = 1 or -1
        $row = \Models\UpvoteModel::getUpvoteDetails($linkid, $uid);

        // Return false if no results are found, else return true
        return ($row == false)? false: true;
    }

    // Removes a downvote record
    public static function removeDownvote($linkid, $uid)
    {
        // Init a link to the db
		$db = \DB::get_instance();

		$stmt = $db->prepare("DELETE FROM `Upvotes` 
                                WHERE `uid` = ? AND `lid` = ? AND `type` = -1");
        $stmt->execute([$uid, $linkid]);
        
        return;
    }
}

