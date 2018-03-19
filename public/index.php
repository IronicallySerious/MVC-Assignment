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

    "/home" => "\Controllers\HomeController",
        "/home/trending" => "\Controllers\TrendingController",
        "/home/following" => "\Controllers\FollowingFeedController",

    "/signup" => "\Controllers\SignUpController"
));

