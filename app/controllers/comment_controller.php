<?php

namespace Controllers;

session_start();

// Deals with displaying comments on link pages
class CommentController
{
    public static function get($linkid, $commenterUsername)
    {
        // Add the comment in the CommentUpvotes table
        \Models\CommentModel::insertCommentUpvote($commenterUsername, $linkid); // Send in the user id of the person who upvoted the comment

        // Add a karma of the OP
        $usernameOfOP = \Models\UserModel::getUserNameByLinkId($linkid);
        $row = \Models\UserModel::getUserDetails($usernameOfOP); // TODO: FIX THIS
        $uidOfOP = $row["uid"];
        \Models\KarmaModel::increaseKarma($uidOfOP);

    }
}