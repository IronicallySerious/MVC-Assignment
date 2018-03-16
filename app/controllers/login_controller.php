<?php

namespace Controllers;

session_start();


// Deals with login page functionalities
class LoginController{

    // Serves login page to GET requests
    public function get()
    {
        // Render the home page if the user is logged in instead of the login page again
        if(\Models\UserModel::isUserSignedIn() == false)
        {
            echo \View\Loader::make()->render('templates/login.twig');
        }
        if(\Models\UserModel::isUserSignedIn() == true)
        {
            echo \View\Loader::make()->render('templates/home.twig');
        }
    }

    // Responds to the login form on login.twig
    public function post()
    {
        // Initialises the user data into separate variables recieved via POST request
        $username = $_POST["username"];
        $hashedPassword = sha1($_POST["password"]); // To make the database secure

        // Fires the UserModel to find user details in the database
        $row = \Models\UserModel::find($username, $hashedPassword);

        // Check if the query returned a result
        if(count($row) == 1)
        {
            \Models\UserModel::setUserIsSignedIn(true);

            // Initialising SESSION variables for further use
            $_SESSION["username"] = $username;
            $_SESSION["karma"] = $row["karma"];
            \Models\UserModel::setUserIsSignedIn(true);

            echo \View\Loader::make()->render('templates/home.twig');
        }
        else
        {
            echo \View\Loader::make()->render('templates/login.twig',
                                                array(
                                                    "ErrorCode" => "Incorrect username"
                                                ));
        }
    }

}