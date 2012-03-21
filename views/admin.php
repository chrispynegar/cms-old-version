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

if(isset($_GET['system'])) {
	$system = $_GET['system'];
} else {
	$system = NULL;
}

?>

<ul class="system-admin">
	<li><a href="<?php echo SITE_URL; ?>admin/" title="Admin Dashboard">Admin Dashboard</a></li>
	<?php if($system == 'article'): ?>
	<li><a href="<?php echo SITE_URL; ?>admin/edit-article.php?id=<?php echo $_GET['id']; ?>" title="Edit Article">Edit Article</a></li>
    <?php endif; ?>
	<li><a href="<?php echo SITE_URL; ?>components/users/login/process.php?logout=true">Logout</a></li>
</ul>