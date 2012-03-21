<?php

/**
 * Develop21
 *
 * @package Article Editor - Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

$article = Article::find_by_id($_GET['id']);

?>

<div id="modal-mask" class="close-modal"></div>

<div id="article_editor" class="modal-window edit-article">
	<h3>Edit Article</h3>
	<label for="edit-article-name" class="label">Name</label>
	<input type="text" name="edit_article_name" id="edit-article-name" class="textbox input" value="<?php echo $article->name; ?>" />
	<label for="edit-article-content" class="label">Content</label>
	<textarea name="edit_article_content" id="edit-article-content" class="editor textarea input"><?php echo $article->content; ?></textarea>
	<input type="submit" name="edit_article_submit" class="button input" value="Save" />
</div>