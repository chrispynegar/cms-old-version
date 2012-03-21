</div>
        <div class="sidebar">
        	<h3>Logged In Users</h3>
            <table class="sidebar-table">
            	<tr>
                    <th>ID</th>
                    <th>Username</th>
                </tr>
            </table>
            <h3>Most Popular Articles</h3>
			<table class="sidebar-table">
				<tr>
					<th>ID</th>
					<th>Article</th>
					<th>Hits</th>
				</tr>
				<?php
					$most_popular_articles = Article::most_popular();
					foreach($most_popular_articles as $mpa):
				?>
				<tr>
					<td><?php echo $mpa->id; ?></td>
					<td><?php echo $mpa->name; ?></td>
					<td><?php echo $mpa->hits; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
        </div>
        <div class="footer">
            <div class="footer-left">
                <ul>
                    <li><a href="#">Footer Link One</a></li>
                    <li><a href="#">Footer Link Two</a></li>
                    <li><a href="#">Footer Link Three</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <p>&copy; Custom CMS 2012</p>
            </div>
        </div>
    </div>

</body>
</html>