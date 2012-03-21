<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" media="screen" href="../templates/admin/newdefault/css/modal.css" />
    <link rel="stylesheet" media="screen" href="../templates/admin/newdefault/css/style.css" />
    <script src="../library/javascripts/jquery.js"></script>
    <script src="../library/javascripts/modal.js"></script>
    <script src="../templates/admin/newdefault/js/script.js"></script>
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
<body>

	<div class="header">
    	<div class="header-left">
        	<h1>Custom CMS</h1>
        </div>
        <div class="header-right">
        	<p><a href="../" title="Preview Website">Preview Website</a></p>
            <p>Welcome back <a href="./profile.php?id=<?php echo $_SESSION['user_id']; ?>" title="Your Profile"><?php echo $_SESSION['user_username']; ?></a> you have <a href="./messages.php"><?php echo Message::unread_messages($_SESSION['user_id']); ?></a> unread message<?php if(Message::unread_messages($_SESSION['user_id']) != 1) { echo 's'; } ?>.</p>
        </div>
    </div>
    <div class="wrapper">
    	<ul class="nav">
        	<li><a href="./" title="Dashboard">Dashboard</a></li>
            <li>
            	<a href="#">Content</a>
                <ul class="subnav">
                	<li><a href="./manage-pages.php" title="Manage Pages">Pages</a></li>
                    <li><a href="./manage-articles.php" title="Manage Articles">Articles</a></li>
                    <li><a href="./manage-categories.php" title="Manage Categories">Categories</a></li>
					<li><a href="./manage-comments.php" title="Manage Comments">Comments</a></li>
                </ul>
            </li>
            <li>
            	<a href="#">Menu</a>
                <ul class="subnav">
                	<li><a href="./create-menu.php" title="Add Another Menu">Add Menu</a></li>
                    <li><a href="./manage-menus.php" title="Manage Menus">Manage Menus</a></li>
                </ul>
            </li>
            <li>
            	<a href="#">User</a>
                <ul class="subnav">
                	<li><a href="./create-user.php" title="Create a New User">Add User</a></li>
                    <li><a href="./manage-users.php" title="Manage Users">Manage Users</a></li>
                    <li><a href="./messages.php" title="Manage Your Messages">Messages</a></li>
                </ul>
            </li>
            <li>
            	<a href="#">Extensions</a>
                <ul class="subnav">
                	<li><a href="./manage-modules.php" title="Manage Modules">Modules</a></li>
                    <li><a href="./templates.php" title="Manage Templates">Templates</a></li>
                    <li><a href="./extensions.php"  title="Manage Extensions">Manage Extensions</a></li>
                    <li><a href="./install.php"  title="Install an Extension">Install</a></li>
                </ul>
            </li>
            <li><a href="./settings.php" title="System Settings">Settings</a></li>
            <li><a href="./logout.php" title="Logout">Logout</a></li>
        </ul>
    	<div class="content">
        	<h2><?php echo $title; ?></h2>
            <?php if(isset($_SESSION['message'])) {
				echo '<div class="message">'.$_SESSION['message'].'</div>';
				unset($_SESSION['message']);
			} ?>