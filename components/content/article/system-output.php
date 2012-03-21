<?php

/**
 * Develop21
 *
 * @package Article View - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

global $session;

if($session->is_logged_in()) {
	$user = User::find_by_id($session->user_id);
}

if($_GET['id']):

$article = Article::find_by_id($_GET['id']);

$author = User::find_by_id($article->author);

$article->add_hit($article->id, $article->hits + 1);

?>

<div class="article">
	<h2 class="article-name"><?php echo $article->name; ?></h2>
	<div class="article-author">By <?php echo $author->fullname(); ?></div>
	<div class="article-date">Created on <?php echo datetime_to_text($article->date_created); ?></div>
	<div class="article-content"><?php echo $article->content; ?></div>
</div>

<?php if($article->comments == 1): ?>

<div class="article-comments">
	<h3>Comments</h3>
	<?php $comment_count = Comment::count_specific('article', $article->id); ?>
	<div class="comment-count">
		<?php if($comment_count == 0): ?>
		There are no comments on this article.
		<?php elseif($comment_count == 1): ?>
		There is 1 comment on this article.
		<?php else: ?>
		There are <?php echo $comment_count; ?> comments on this article.
		<?php endif; ?>
	</div>
	<?php $comments = Comment::article_comments($article->id); ?>
	<?php foreach($comments as $comment): ?>
	<div class="comment">
		<?php if($comment->author != 0): ?>
		<?php $comment_author = User::find_by_id($comment->author); ?>
		<div class="comment-author"><a href="<?php echo SITE_URL.'index.php?system=profile&id='.$comment_author->id; ?>" title="<?php echo $comment_author->fullname(); ?>'s profile"><?php echo $comment_author->fullname(); ?></a> said:</div>
		<?php else: ?>
		<div class="comment-author"><?php echo $comment->name; ?></div>
		<?php endif; ?>
		<div class="comment-date">Posted on <?php echo datetime_to_text($comment->date_created); ?></div>
		<div class="comment-content"><?php echo $comment->comment; ?></div>
	</div>
	<?php endforeach; ?>
</div>

<div class="new-article-comment">
	<h3>Post a Comment</h3>
	<form action="<?php echo SITE_URL.'components/content/article/process_comment.php' ?>" method="post">
		<?php if($session->is_logged_in()): ?>
		<input type="hidden" name="comment_name" value="<?php echo $user->fullname(); ?>" />
		<input type="hidden" name="comment_email" value="<?php echo $user->email; ?>" />
		<input type="hidden" name="comment_url" value="<?php echo $user->url; ?>">
		<input type="hidden" name="comment_author" value="<?php echo $user->id; ?>">
		<?php endif; ?>
		<?php if(!$session->is_logged_in()): ?>
		<label for="comment_name" class="label">Name</label>
		<input type="text" name="comment_name" id="comment_name" class="textbox input" value="" />
		<label for="comment_email" class="label">Email</label>
		<input type="text" name="comment_email" id="comment_email" class="textbox input" value="" />
		<label for="comment_url" class="label">URL</label>
		<input type="text" name="comment_url" id="comment_url" class="textbox input" value="" />
		<input type="hidden" name="comment_author" value="0" />
		<?php endif; ?>
		<label for="comment_content" class="label">Comment</label>
		<textarea name="comment_content" id="comment_content" class="textarea input"></textarea>
		<input type="hidden" name="comment_article_id" value="<?php echo $article->id; ?>" />
		<input type="hidden" name="currenturl" value="<?php echo currenturl(); ?>" />
		<input type="submit" name="comment_submit" class="button input" value="Submit Comment" />
	</form>
</div>

<?php endif; ?>

<?php endif; ?>

<?php if(!$_GET['id']): ?>

<p>No article found</p>

<?php endif; ?>