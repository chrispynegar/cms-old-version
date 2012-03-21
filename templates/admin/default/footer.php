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
		</div>
		<div class="sidebar">
			<h3 class="sidebarheading">Logged In Users</h3>
			<h3 class="sidebarheading">Popular Articles</h3>
			<table class="table">
				<tr>
					<th>Article</th>
					<th>Hits</th>
				</tr>
				<?php
					$most_popular_articles = Article::most_popular();
					foreach($most_popular_articles as $mpa):
				?>
				<tr>
					<td><?php echo $mpa->name; ?></td>
					<td><?php echo $mpa->hits; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="footer">
			<p>&copy; Develop21 CMS <?php echo date('Y'); ?></p>
		</div>
	</div>
	
</body>
</html>