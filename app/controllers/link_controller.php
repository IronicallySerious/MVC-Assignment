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
												'upvotes' => $upvotes,
												'username' => $username
											));
	}

	public static function getSortedComments($slug, $comments)
	{
		// Initialising variables to send to twig file as arguments
		$queryresult = \Models\LinkModel::find($slug, "ascending");
		// Use the passed in comments
		$upvotes = \Models\UpvoteModel::getUpvotes($queryresult['id']);
		$username = $_SESSION["username"];

		echo \View\Loader::make()->render('templates/comments.twig',
											array(
												'linkdata' => $queryresult,
												'comments' => $comments,
												'upvotes' => $upvotes,
												'username' => $username
											));
	}

	// Called when a comment is posted on the link viewer page
	public static function post($slug)
	{
		if($_POST["sortparameter"] != NULL)
		{
			$comments = \Models\CommentModel::findAndSortByParameter($slug, $_POST["sortparameter"]);

			self::getSortedComments($slug, $comments);
		}

		// Prepare comment details to save in Comments table
		$content = $_POST['content'];
		$linkid = $slug;
		$row = \Models\UserModel::getUserDetails(\Models\UserModel::getUserNameByLinkId($slug));
		
		// Initiate INSERT query
		\Models\CommentModel::insert($content,$linkid, $uid, $_SESSION["username"]);

		// Re-Rendering the page to incorporate the new comment
		self::get($linkid);
	}
}