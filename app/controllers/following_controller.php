<?php

                            //                                                                  //
                            // !  DO NOT CONFUSE THIS FILE WITH THE FOLLOWER CONTROLLER FILE  ! //
                            // !  DO NOT CONFUSE THIS FILE WITH THE FOLLOWER CONTROLLER FILE  ! //
                            // !  DO NOT CONFUSE THIS FILE WITH THE FOLLOWER CONTROLLER FILE  ! //
                            //                                                                  //

namespace Controllers;

session_start();

// Renders the following users page
class FollowingController{
    public static function get($username)
    {
        // Acquire the user details
        $row = \Models\UserModel::getUserDetails($username);

        // Acquire the following users list as an array
        $followingArray = explode(" ", $row["followingids"]);

        // Send the following users list while rendering the follower page
        echo \View\Loader::make()->render('templates/following.twig',
											array(
                                                'following' => $followingArray,
                                                'username' => $username
											));
    }
}