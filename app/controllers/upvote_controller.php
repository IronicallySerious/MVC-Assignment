<?php

namespace Controllers;

session_start();

// Handles the upvoting procedure
class UpvoteController{
    public static function get($linkid, $username, $modifier = 0)
    {
        // if a comment was upvoted
        if($modifier == 1)
        {
            var_dump($modifier);
            \Models\CommentModel::increaseUpvote($username);
            self::get($linkid, $username);
        }

        $row = \Models\UserModel::getUserDetails($username);
        $_SESSION["uid"] = $row["uid"];

        if(\Models\UpvoteModel::hasUserUpvotedThisLink($linkid, $_SESSION["uid"]) == false) 
        // If the user DID NOT already upvote this link
        {
            if(\Models\DownvoteModel::hasUserDownvotedThisLink($linkid, $_SESSION["uid"]) == true)
            {
                // Remove the upvote entry
                \Models\DownvoteModel::removeDownvote($linkid, $_SESSION["uid"]);
            }
            /*
                Set the type of upvote
                --> $type = 1 for upvote
                --> $type = -1 for downvote
            */
            $type = 1;

            // Insert the upvote record into the Upvotes table
            \Models\UpvoteModel::insertUpvote($linkid, $type, $_SESSION["uid"]);

            // Increase karma of the OP
            \Models\KarmaModel::increaseKarmaByLinkId($linkid);
        }
        else
        {
            // TODO: Add ability to take back the upvote
            ; // Do nothing if the user DID upvote it
        }
        
        \Controllers\LinkController::get($linkid);
    }
}