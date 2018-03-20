<?php

namespace Controllers;

session_start();

// Deals with user profile page renders
class UserController{

    // Renders the user profile page
    public function get($username)
    {
        // Acquire username, karma, followers, followerids, following, followingids
        $row = \Models\UserModel::getUserDetails($username);

        if($row)
        // If the query returned a result for the username
        {
            // Render user profile page
            echo \View\Loader::make()->render('templates/user.twig',
                                                array(
                                                    'userdata' => $row
                                                ));
        }
        else
        // If the query returned nothing
        {
            // Render Error 404 page
            echo \View\Loader::make()->render('templates/ERROR.twig');
        }
    }

    // TODO: Add description
    public function post()
    {
        echo 'post request';
    }

}