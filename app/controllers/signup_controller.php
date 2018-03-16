<?php

namespace Controllers;

session_start();


// Deals with signing up
class SignUpController{

    // Serves signup page to GET requests
    public function get()
    {
        echo \View\Loader::make()->render('templates/signup.twig');
    }

    // Creates an entry in 'Users' of the database
    public function post()
    {
        // Initialises the user data into separate variables recieved via POST request
        $username = $_POST["username"];
        $hashedPassword = sha1($_POST["password"]); // To make the database secure

        // Acquire users(if any) in the table of the same username
        $rows = \Models\UserModel::findWithoutPassword()($username);

        // If the rows is not empty
        if(count($rows) == 0)
        {
            // Fires the UserModel to insert user details into the database
            \Models\UserModel::insertUser($username, $hashedPassword);

            // Redirect to homepage
            echo \View\Loader::make()->render('templates/home.twig',
                                                array(
                                                    "ErrorCode" => "OK"
                                                ));
        }
        else
        {
            echo \View\Loader::make()->render('templates/home.twig',
                                                array(
                                                    "ErrorCode" => "The user already exists"
                                                ));
        }
        
    }
}

?>