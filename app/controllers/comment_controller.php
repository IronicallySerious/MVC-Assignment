<?php

namespace Controllers;

session_start();

// Deals with displaying comments on link pages
class CommentController
{
    public static function get($linkid, $commenterUsername)
    {
        // Acquire the user id of the username user $commenterUsername
        
        // Add the comment in the CommentUpvotes table
        \Models\CommentModel::insertCommentUpvote($commenterUsername, $linkid); // Send in the user id of the person who upvoted the comment

        // Add a karma of the OP
        $usernameOfOP = \Models\UserModel::getUserNameByLinkId($linkid);
        $row = \Models\UserModel::getUserDetails($usernameOfOP); // TODO: FIX THIS
        $uidOfOP = $row["uid"];
        \Models\KarmaModel::increaseKarma($uidOfOP);

        // Redirect to link viewer page
        header("Location: localhost:8000/link/" . $linkid);
    }

    // Sorts the comments in a particular order
    public static function post()
    {
        // Acquire the sorting parameter user selected
        $sortParameter = $_POST["sortparameter"];

        // Acquire comment query results using a particular order parameter
        $sortedComments = \Models\CommentModel::findAndSortByParameter($linkid, $sortParameter);
    }
}