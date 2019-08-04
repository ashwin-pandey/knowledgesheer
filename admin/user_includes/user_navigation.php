<div class="blog-menu">
	<a href="./users.php" style="text-decoration: none; color: #4e4e4e;"><h6><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;User Dashboard</h6></a>
	<hr>
	<ul class="">
		<li>
			<a class="<?php if($user_page == 'view_all_users') {echo 'blog-menu-active';} ?>" href="users.php?source=view_all_users">View All Users</a>
		</li>
		<li>
			<a class="<?php if($user_page == 'add_user') {echo 'blog-menu-active';} ?>" href="users.php?source=add_user">Add User</a>
		</li>
		<li>
			<a class="<?php if($user_page == 'user_roles') {echo 'blog-menu-active';} ?>" href="users.php?source=user_roles">User Roles</a>
		</li>
	</ul>
</div>