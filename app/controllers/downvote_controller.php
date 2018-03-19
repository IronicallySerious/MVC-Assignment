<?php

namespace Controllers;

class DownvoteController{

    // Decreases the karma of an OP
    public static function get($linkid, $username)
    {
        $row = \Models\UserModel::getUserDetails($username);
        $_SESSION["uid"] = $row["uid"];

        if(\Models\DownvoteModel::hasUserDOWNVOTEDThisLink($linkid, $_SESSION["uid"]) == false) 
        // If the user DID NOT already downvote this link
        {
            // If the user upvoted this link before
            if(\Models\UpvoteModel::hasUserUpvotedThisLink($linkid, $_SESSION["uid"]) == true)
            {
                // Remove the upvote entry
                \Models\UpvoteModel::removeUpvote($linkid, $_SESSION["uid"]);
            }
            
            /*
                Set the type of upvote
                --> $type = 1 for upvote
                --> $type = -1 for downvote
            */
            $type = -1;

            // Insert the downvote record into the Upvotes table
            \Models\UpvoteModel::insertUpvote($linkid, $type, $_SESSION["uid"]);

            // Decrease karma of the OP
            \Models\KarmaModel::decreaseKarmaByLinkId($linkid);
        }
        else
        {
            ; // Do nothing if the user DID downvote it
        }
        
        header("Location: /link/" . $linkid);
    }
}