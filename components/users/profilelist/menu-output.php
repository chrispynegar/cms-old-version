<?php

/**
 * Develop21
 *
 * @package User Login - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

$users = User::find_all_enabled();

foreach($users as $user):

?>

<div class="profile-list">
	<div class="profile-image">
		
	</div>
	<div class="profile-name">
		<a href="index.php?system=profile&amp;id=<?php echo $user->id; ?>"><?php echo $user->fullname(); ?></a>
	</div>
	<div class="profile-bio">
		<?php echo $user->bio; ?>
	</div>
</div>

<?php endforeach; ?>