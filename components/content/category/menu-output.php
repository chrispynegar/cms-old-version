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

// update needed! need to require category child categories

$params = $menuitem->parameters;

$param = explode(',', $params);

$category = $param[0];
$title_linkable = $param[1];
$display_author = $param[2];
$author_linkable = $param[3];
$display_date = $param[4];

$get_category = Category::find_by_id($category);

$find_articles = Article::find_by_category($get_category->id);

?>

<?php foreach($find_articles as $article): ?>
<?php $author = User::find_by_id($article->author); ?>
<div class="article">
	<h3><?php if($title_linkable == 1): ?><a href="index.php?system=article&amp;id=<?php echo $article->id; ?>" title="<?php echo $article->name; ?>"><?php endif; ?><?php echo $article->name; ?><?php if($title_linkable == 1): ?></a><?php endif; ?></h3>
	<div class="article-author">Created by <?php echo $author->username; ?></div>
	<div class="article-date">Created on <?php echo datetime_to_text($article->date_created); ?></div>
	<div class="article-content"><?php echo $article->content; ?></div>
</div>
<?php endforeach; ?>