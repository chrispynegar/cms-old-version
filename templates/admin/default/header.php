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
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" media="screen" href="../library/stylesheets/reset.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../templates/admin/newdefault/css/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../library/stylesheets/modal.css" />
	<script src="../library/javascripts/jquery.js"></script>
	<script src="../templates/admin/default/js/script.js"></script>
	<script src="../library/javascripts/modal.js"></script>
	<?php
		$editor_settings = Setting::find_by_id(1);
		$find_editor = Editor::find_by_id($editor_settings->editor);
	?>
	<script src="../components/editors/<?php echo $find_editor->directory; ?>/<?php echo $find_editor->source; ?>"></script>
	<script>
		<?php echo $find_editor->script; ?>
	</script>
	<?php if(isset($add_header)) { echo $add_header; } ?>
	<title><?php echo $title; ?></title>
</head>
<body class="body">

	<div class="wrapper">
		<div class="header">
			<div class="header-left"><h1>Develop21 CMS</h1></div>
			<div class="header-right">
				<p>Logged in as <a href="./profile.php?id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['user_username']; ?></a><br /><a href="<?php echo SITE_URL; ?>" title="Preview Website">Preview Website</a></p>
			</div>
		</div>
		<ul class="nav">
			<li><a href="./">Dashboard</a></li>
			<li><a href="#" class="activate-content-nav">Content</a></li>
			<li><a href="#" class="activate-menu-nav">Menu</a></li>
			<li><a href="#" class="activate-module-nav">Modules</a></li>
			<li><a href="#" class="activate-user-nav">User</a></li>
			<li><a href="#" class="activate-messages-nav">Messages</a></li>
			<li><a href="./settings.php">Settings</a></li>
			<li><a href="./logout.php">Logout</a></li>
		</ul>
		<ul class="content-nav subnav nav">
			<li><a href="./create-page.php">Create Page</a></li>
			<li><a href="./manage-pages.php">Manage Pages</a></li>
			<li><a href="./create-category.php">Create Category</a></li>
			<li><a href="./manage-categories.php">Manage Categories</a></li>
			<li><a href="./create-article.php">Create Article</a></li>
			<li><a href="./manage-articles.php">Manage Articles</a></li>
		</ul>
		<ul class="menu-nav subnav nav">
			<li><a href="./create-menu.php">Create Menu</a></li>
			<li><a href="./manage-menus.php">Manage Menus</a></li>
		</ul>
		<ul class="module-nav subnav nav">
			<li><a href="./modules.php">Add Module</a></li>
			<li><a href="./manage-modules.php">Manage Modules</a></li>
		</ul>
		<ul class="user-nav subnav nav">
			<li><a href="./create-user.php">Create User</a></li>
			<li><a href="./manage-users.php">Manage Users</a></li>
		</ul>
		<ul class="messages-nav subnav nav">
			<li><a href="./compose-message.php">Compose Message</a></li>
			<li><a href="./my-messages.php">My Messages</a></li>
		</ul>
		<div class="content">
			<h2><?php echo $title; ?></h2>
			<?php if(isset($_SESSION['message'])) {
				echo '<p class="message">'.$_SESSION['message'].'</p>';
				unset($_SESSION['message']);
			} ?>
			