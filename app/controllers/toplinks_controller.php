<?php

namespace Controllers;

// Deals with displaying top rated links
class TopLinksController{

    // Renders the trending links page
    public static function get()
    {
        $links = \Models\LinkModel::getTopLinks();

        echo \View\Loader::make()->render('templates/home.twig',
				array(
					'links' => $links,
					'username' => $_SESSION["username"],
					'template' => "Top Links" 
				));

    }
}