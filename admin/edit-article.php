<?php

/**
 * Develop21
 *
 * @package Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

// if the configuration file doesn't exist, run the installer
if(!file_exists('../config.php')) {
	header('Location: ../install/index.php');
	exit();
}

// require the loader
require_once('../library/load.php');

// check that the user is logged in
logged_in();

// check that the user access to this
Permission::access(4);

// get article
if(isset($_GET['id'])) {
	$article_id = $_GET['id'];
	if($article = Article::find_by_id($article_id)) {
		// article found
		$article_name = $article->name;
		$date_created = $article->date_created;
	} else {
		// article not found
		$session->message('No article selected.');
		redirect('manage-articles.php');
	}
}

// set page title
$title = 'Edit Article: '.$article->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="./edit-article.php?id=<?php echo htmlentities($article_id); ?>" method="">
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $article->name; ?>" />
	<label for="content" class="label">Content</label>
	<textarea name="content" id="content" class="editor input"><?php echo $article->content; ?></textarea>
	<div class="buttonset">
		<input type="submit" name="submit" class="button input" value="Save" />
	</div>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>