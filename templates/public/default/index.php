<?php

/**
 * Develop21
 *
 * @package Default Template - Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<?php $website->head(); ?>
	<link rel="stylesheet" media="screen" href="library/stylesheets/reset.css" />
	<link rel="stylesheet" media="screen" href="library/stylesheets/admin.css" />
	<link rel="stylesheet" media="screen" href="templates/public/default/css/style.css" />
	<script src="components/editors/<?php echo $find_editor->directory; ?>/<?php echo $find_editor->source; ?>"></script>
	<script>
		<?php echo $find_editor->script; ?>
	</script>
</head>
<body>
	
	<?php $website->admin(); ?>
	
	<div class="wrapper">
		<div class="header">
			<h1><?php $website->name(); ?></h1>
		</div>
		<?php $website->main_menu(); ?>
		<?php if(isset($_SESSION['message'])) {
			echo '<p class="message">'.$_SESSION['message'].'</p>';
			unset($_SESSION['message']);
		} ?>
		<div class="content">
			<?php $website->content(); ?>
		</div>
		<div class="sidebar">
			<?php $website->modules(); ?>
		</div>
		<div class="footer">
			<p>&copy; <?php $website->name(); echo ' '.date('Y'); ?></p>
		</div>
	</div>
	
</body>
</html>