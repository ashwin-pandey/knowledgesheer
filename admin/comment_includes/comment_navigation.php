<div class="blog-menu">
	<a href="./comments.php" style="text-decoration: none; color: #4e4e4e;"><h6><i class="fas fa-comments"></i>&nbsp;&nbsp;&nbsp;Comment Dashboard</h6></a>
	<hr>
	<ul class="">
		<li>
			<a class="<?php if($comments_page == 'view_all_comments') {echo 'blog-menu-active';} ?>" href="comments.php?source=view_all_comments">View All Comments</a>
		</li>
		<li>
			<a class="<?php if($comments_page == 'unapproved_comments') {echo 'blog-menu-active';} ?>" href="comments.php?source=unapproved_comments">Unapproved Comments</a>
		</li>
	</ul>
</div>