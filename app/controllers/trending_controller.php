<?php

namespace Controllers;

session_start();

class TrendingController{

    // Renders the trending page
    public static function get()
    {
        $links = \Models\LinkModel::getTrendingLinks(); // Returns the most trending links

        echo \View\Loader::make()->render('templates/home.twig', /* TODO: ADD SUPPORT for passing username */
				array(
                    'links' => $links,
                    'username' => $_SESSION["username"]
				));
    }

}