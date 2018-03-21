<?php

namespace Controllers;

session_start();

// Renders follower list of the user
class FollowerController{
    public static function get($username)
    {
        // Acquire the user details
        $row = \Models\UserModel::getUserDetails($username);

        // Acquire the follower list as an array
        $followerArray = explode(" ", $row["followerids"]);

        // Send the follower list while rendering the follower page
        echo \View\Loader::make()->render('templates/followers.twig',
											array(
                                                'followers' => $followerArray,
                                                'username' => $username
											));
    }
}