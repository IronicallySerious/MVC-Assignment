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
        "/link/upvote/:number/:alpha" => "\Controllers\UpvoteController",
        "/link/downvote/:number/:alpha" => "\Controllers\DownvoteController",

    "/comment/upvote/:number/:string" => "\Controllers\CommentController",

    "/u/:alpha" => "\Controllers\UserController",
        "/u/:alpha/followers" => "\Controllers\FollowerController",
        "/u/:alpha/following" => "\Controllers\FollowingController",

    "/home" => "\Controllers\HomeController",
        "/home/trending" => "\Controllers\TrendingController",
        "/home/following" => "\Controllers\FollowingFeedController", /* TODO: Add following feed */

    "/signup" => "\Controllers\SignUpController",

    "/toplinks" => "\Controllers\TopLinksController"
));

