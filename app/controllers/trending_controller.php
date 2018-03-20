<?php

namespace Controllers;

session_start();

class TrendingController{

    // Renders the trending page
    public static function get()
    {
        $links = \Models\LinkModel::getTrendingLinks(); // Returns the most trending links as DESC order of 
                                                        // traffic = clicks + upvotes
                                                        // TODO: FIX THIS

        echo \View\Loader::make()->render('templates/home.twig', /* TODO: ADD SUPPORT for passing username */
				array(
					'links' => $links
				));
    }

}