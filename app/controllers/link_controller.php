<?php

namespace Controllers;

session_start();

// Displays links underneath link view pages
class LinkController{

	// Displays the contents of a link
	public function get($slug)
	{
		// Initialising variables to send to twig file as arguments
		$queryresult = \Models\LinkModel::find($slug, "ascending");
		$comments = \Models\CommentModel::find($slug);
		$upvotes = \Models\UpvoteModel::getUpvotes($queryresult['id']);
		$username = $_SESSION["username"];

		echo \View\Loader::make()->render('templates/comments.twig',
											array(
												'linkdata' => $queryresult,
												'comments' => $comments,
												'upvotes' => $upvotes
											));
	}

	// Called when a comment is posted on the link viewer page
	public function post($slug)
	{
		// Create new model and save in db
		$content = $_POST['content'];
		$linkid = $slug;

		\Models\CommentModel::insert($content,$linkid, $_SESSION["uid"], $_SESSION["username"]);

		// Re-Rendering the page to incorporate the new comment
		self::get($linkid);
	}
}