<?php

namespace Controllers;

// Deals with displaying top rated links
class TopLinksController{

    // Renders the trending links page
    public static function get()
    {
        $links = \Models\LinkModel::getTrendingLinks();
    }
}