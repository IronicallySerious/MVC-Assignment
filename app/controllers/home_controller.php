<?php

namespace Controllers;

session_start();

class HomeController{
	
	// Renders the home page
	public function get()
	{
		$links = \Models\LinkModel::all();

		echo \View\Loader::make()->render('templates/home.twig',
				array(
					'links' => $links,
					'username' => $_SESSION["username"],
					'template' => "New Links" 
				));
	}

	// Renders the homepage along with handling the insertion of a new link
	public function post()
	{
		// Create new model and save in db
		$title = $_POST['title'];
		$url = $_POST['url'];
		$username = $_POST['username'];
		$tags = $_POST['tags'];

		// Check for stupidity :P
		if($title == "" || $url == "")
		{
			if($username == "")
			{
				\Controllers\LoginController::get();
			}

			return;
		}
		else
		{
			// Insert the link in the database
			\Models\LinkModel::insert($title, $url, $username, $tags);

			$links = \Models\LinkModel::all();

			echo \View\Loader::make()->render('templates/home.twig',
					array(
						'links' => $links,
						'username' => $username
					));
		}
	}
}