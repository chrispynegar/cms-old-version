<?php

/**
 * Develop21
 *
 * @package Category View - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

require_once('../../../library/load.php');

if(isset($_POST['comment_submit'])) {
	$comment = new Comment();
	$comment->article = trim($_POST['comment_article_id']);
	$comment->author = trim($_POST['comment_author']);
	$comment->name = trim($_POST['comment_name']);
	$comment->email = trim($_POST['comment_email']);
	$comment->url = trim($_POST['comment_url']);
	$comment->comment = trim($_POST['comment_content']);
	$comment->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	$currenturl = trim($_POST['currenturl']);
	if($form->required($comment->name, 'Your name') && $form->required($comment->email, 'Your email address') && $form->required($comment->comment, 'Your comment')) {
		if(!$form->validate_email($comment->email)) {
			$session->message('Please enter a valid email address.');
		} else {
			if($comment->save()) {
				$session->message('Thank you, your comment was successfully posted.');
			} else {
				$session->message('Sorry your comment could not be posted at this time.');
			}
			if($currenturl != NULL) {
				redirect($currenturl);
			} else {
				redirect(SITE_URL);
			}
		}
	}
}

?>