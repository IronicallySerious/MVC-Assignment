<?php
require '../vendor/autoload.php';
//require '../app/controllers/home_controller.php'; // THOO undesirable method


class HelloHandler 
{
    function get() 
    {
        echo "Hello, world";
    }
}

class Handler 
{
    function get() 
    {
        echo "another route";
	}
}

Toro::serve(array(
    "/" => "\Controllers\LoginController",
    "/link/:number" => "\Controllers\LinkController",
    "/u/:alpha" => "\Controllers\UserController",
    "/home" => "\Controllers\HomePageController",
    "/signup" => "\Controllers\SignUpController"
));

