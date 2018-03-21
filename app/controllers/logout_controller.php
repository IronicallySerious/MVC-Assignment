<?php

namespace Controllers;

// Deal with getting the user logged out
class LogOutController{
    
    // Destroys all session variables
    public static function get()
    {
        // Destroy session variables
        session_destroy();

        // Render the login page
        echo \View\Loader::make()->render('templates/login.twig');
    }
}