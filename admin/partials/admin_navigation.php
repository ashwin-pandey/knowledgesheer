<?php if (isset($_SESSION['username'])) { ?>

	<!-- left sidebar -->
	<div class="admin-sidebar">
		<div class="short-profile">
			<img class="profile-img" src="../assets/images/profile/<?php echo $_SESSION['user_image']; ?>">
			<div class="profile-name">
				<a href="#" data-toggle="tooltip" data-placement="right" title="Click to View Profile">
					<?php echo $_SESSION['username']; ?>
				</a>
			</div>
			<div class="profile-location">
				<i class="fas fa-map-marker-alt"></i> Mumbai, India
			</div>
			<div class="profile-role">
				<span>
					<?php
						echo $_SESSION['user_role'];
					}

					?>
				</span>
			</div>
		</div>
		<!-- <hr> -->
		<div class="sidebar-navigation-menu">
			<ul class="sidebar-nav">
				<li>
					<a href="index.php" class="<?php if($current_page == 'index') {echo 'active';} ?>">
						<div class="row">
							<div class="col-3">
								<i class="fas fa-tachometer-alt" style="padding-left: 14px;padding-right: 0;"></i>
							</div>
							<div class="col-9">
								Dashboard
							</div>
						</div>
					</a>
				</li>

				<!-- Blog Menu -->
				<li>
					<a href="javascript:;" class="<?php if($current_page == 'blog') {echo 'active';} ?>" data-toggle="collapse" data-target="#demo">
						<div class="row">
							<div class="col-3">
								<i class="fas fa-blog" style="padding-left: 14px;"></i>
							</div>
							<div class="col-9">
								Blog
							</div>
						</div>
					</a>
					<ul id="demo" class="collapse">
						<li>
							<a href="blog.php">Dashboard</a>
						</li>
						<li>
							<a class="<?php if($blog_page == 'view_all_posts') {echo 'blog-menu-active';} ?>" href="blog.php?source=view_all_posts">View All Posts</a>
						</li>
						<li>
							<a class="<?php if($blog_page == 'unapproved_posts') {echo 'blog-menu-active';} ?>" href="blog.php?source=unapproved_posts">Unapproved Posts</a>
						</li>
						<li>
							<a class="<?php if($blog_page == 'add_post') {echo 'blog-menu-active';} ?>" href="blog.php?source=add_post">Add Post</a>
						</li>
						<li>
							<a class="<?php if($blog_page == 'blog_categories') {echo 'blog-menu-active';} ?>" href="blog.php?source=blog_categories">Categories</a>
						</li>
					</ul>
				</li>
				<!-- Blog Menu -->

				<li>
					<a href="javascript:;" class="<?php if($current_page == 'user') {echo 'active';} ?>" data-toggle="collapse" data-target="#demo1">
						<div class="row">
							<div class="col-3">
								<i class="fas fa-users" style="padding-left: 14px;"></i>
							</div>
							<div class="col-9">
								Users
							</div>
						</div>
					</a>
					<ul id="demo1" class="collapse">
						<li>
							<a href="users.php">Dashboard</a>
						</li>
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
				</li>
				<li>
					<a href="comments.php" class="<?php if($current_page == 'comments') {echo 'active';} ?>">
						<div class="row">
							<div class="col-3">
								<i class="fas fa-comments" style="padding-left: 14px;"></i>
							</div>
							<div class="col-9">
								Comments
							</div>
						</div>
					</a>
				</li>
			</ul>
			<ul class="logout sidebar-nav">
				<hr style="margin: 0;border-color: #fff;">
				<li>
					<a href="../includes/logout.php">
						<div class="row">
							<div class="col-3">
								<i class="fas fa-fw fa-power-off" style="padding-left: 14px;"></i>
							</div>
							<div class="col-9">
								Log Out
							</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- left sidebar -->

	<!-- main container -->
	<div class="admin-main-container">
		<!-- top navigation bar -->
		<div class="admin-topbar">
			<nav class="navbar header-navbar">
				<ul class="navbar nav navbar-left">
					<li><a href="index.html">Dashboard</a></li>
				</ul>
			</nav>
		</div>
		<!-- top navigation bar -->