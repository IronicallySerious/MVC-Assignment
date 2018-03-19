<?php

namespace Models;

class KarmaModel{
    
    // Increases karma of a user of a specific id, passed as an argument
    public static function increaseKarma($uid)
    {
        // Init a link to the db
		$db = \DB::get_instance();

		$stmt = $db->prepare("UPDATE Users
								SET karma = karma + 1
								WHERE `uid` = ?");
        $stmt->execute([$uid]);
        
        return;
    }

    // Increases karma of the OP of a particular link post
    public static function increaseKarmaByLinkId($linkid)
    {
        // Acquire username of the OP
        $username = \Models\UserModel::getUserNameByLinkId($linkid);
        
        // Acquire uid of OP
        $row = \Models\UserModel::getUserDetails($username);
        $uid = $row["uid"];

        // Increase karma by one of OP
        self::increaseKarma($uid);

        return;
    }

    // Decreases karma of a user of a specific id, passed as an argument
    public static function decreaseKarma($uid)
    {
        // Init a link to the db
		$db = \DB::get_instance();

		$stmt = $db->prepare("UPDATE Users
								SET karma = karma - 1           
								WHERE uid = ?");        // <-- No checks for negative karma? EVIL...
        $stmt->execute([$uid]);
        
        return;
    }

    // Decreases karma of the OP of a particular link post
    public static function decreaseKarmaByLinkId($linkid)
    {
        // Acquire username of the OP
        $username = \Models\UserModel::getUserNameByLinkId($linkid);
        
        // Acquire uid of OP
        $row = \Models\UserModel::getUserDetails($username);
        $uid = $row["uid"];

        // Decrease karma by one of OP
        self::decreaseKarma($uid);

        return;
    }
}