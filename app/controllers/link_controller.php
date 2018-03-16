<?php

namespace Controllers;

session_start();

// Displays links underneath link view pages
class LinkController{

	// TODO: Add description
	public function get($slug)
	{
		$queryresult = \Models\LinkModel::find($slug);
		$comments = \Models\CommentModel::find($slug);

		echo \View\Loader::make()->render('templates/comments.twig',
					array(
						'linkdata' => $queryresult,
						'comments' => $comments
					));
	}

	// TODO: Add description
	public function post($slug)
	{
		// Create new model and save in db
		$content = $_POST['content'];
		$linkid = $slug;

		\Models\CommentModel::insert($content,$linkid);

		self::get($linkid);
	}
}