<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
	<div class="main-navbar">
		<nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
			<a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
				<div class="d-table m-auto">
				<!-- <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="images/shards-dashboards-logo.svg" alt="Shards Dashboard"> -->
				<span class="d-none d-md-inline ml-1">Dashboard</span>
				</div>
			</a>
			<a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
				<i class="material-icons">&#xE5C4;</i>
			</a>
		</nav>
	</div>
	<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
		<div class="input-group input-group-seamless ml-3">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<i class="fas fa-search"></i>
				</div>
			</div>
			<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> 
		</div>
	</form>
	<div class="nav-wrapper">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?php if($current_page == 'index') {echo 'active';} ?>" href="index.php">
					<i class="material-icons">dashboard</i>
					<span>Main Dashboard</span>
				</a>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle <?php if($current_page == 'blog') { echo 'active';} ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					<i class="material-icons">edit</i>
					<span>Blog</span>
				</a>
				<div class="dropdown-menu dropdown-menu-small">
					<a class="dropdown-item" href="blog.php">Dashboard</a>
					<a class="dropdown-item" href="blog.php?source=view_all_posts">View All Posts</a>
					<a class="dropdown-item" href="blog.php?source=add_post">Add New Post</a>
					<a class="dropdown-item" href="comments.php">Comments</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle <?php if($current_page == 'quotes') { echo 'active';} ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					<i class="material-icons">format_quote</i>
					<span>Quotes</span>
				</a>
				<div class="dropdown-menu dropdown-menu-small">
					<a class="dropdown-item" href="quotes.php">Dashboard</a>
					<a class="dropdown-item" href="quotes.php?source=view_all_quotes">View All Quotes</a>
					<a class="dropdown-item" href="quotes.php?source=add_quote">Add New</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle <?php if($current_page == 'users') { echo 'active';} ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					<i class="material-icons">people</i>
					<span>Users</span>
				</a>
				<div class="dropdown-menu dropdown-menu-small">
					<a class="dropdown-item" href="users.php">Dashboard</a>
					<a class="dropdown-item" href="users.php?source=view_all_users">View All Users</a>
					<a class="dropdown-item" href="users.php?source=add_user">Add New</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle <?php if($current_page == 'categories') {echo 'active';} ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
					<i class="material-icons">category</i>
					<span>Categories</span>
				</a>
				<div class="dropdown-menu dropdown-menu-small">
					<a class="dropdown-item" href="categories.php">Blog Categories</a>
					<a class="dropdown-item" href="quote_categories.php">Quote Categories</a>
				</div>
			</li>
		</ul>
	</div>
</aside>
<!-- End Main Sidebar -->
<main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
	<div class="main-navbar sticky-top bg-white">
		<!-- Main Navbar -->
		<nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
			<form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
				<div class="input-group input-group-seamless ml-3">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<i class="fas fa-search"></i>
						</div>
					</div>
					<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
				</div>
			</form>
			<ul class="navbar-nav border-left flex-row">
				<li class="nav-item border-right dropdown notifications">
					<a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="nav-link-icon__wrapper">
							<i class="material-icons">&#xE7F4;</i>
							<span class="badge badge-pill badge-danger">2</span>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="#">
							<div class="notification__icon-wrapper">
								<div class="notification__icon">
									<i class="material-icons">&#xE6E1;</i>
								</div>
							</div>
							<div class="notification__content">
								<span class="notification__category">Analytics</span>
								<p>Your website’s active users count increased by
								<span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
							</div>
						</a>
						<a class="dropdown-item" href="#">
							<div class="notification__icon-wrapper">
								<div class="notification__icon">
									<i class="material-icons">&#xE8D1;</i>
								</div>
							</div>
							<div class="notification__content">
								<span class="notification__category">Sales</span>
								<p>Last week your store’s sales count decreased by
								<span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
							</div>
						</a>
						<a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<?php if (empty($_SESSION['user_image'])) { ?>
							<img class="user-avatar rounded-circle mr-2" src="../assets/images/profile/user.png" alt="">
						<?php } else { ?>
							<img class="user-avatar rounded-circle mr-2" src="../assets/images/profile/<?php echo $_SESSION['user_image']; ?>">
						<?php } ?>
						<span class="d-none d-md-inline-block">	
						<?php 
							if (isset($_SESSION['username'])) {
								echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
							}
						?>

						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-small">
						<a class="dropdown-item" href="users.php?source=edit_user&edit_user=<?php echo $_SESSION['user_id']; ?>">
							<i class="material-icons">&#xE7FD;</i> Profile
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item text-danger" href="../includes/logout.php">
							<i class="material-icons text-danger">&#xE879;</i> Logout
						</a>
					</div>
				</li>
			</ul>
			<nav class="nav">
			<a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
			<i class="material-icons">&#xE5D2;</i>
			</a>
			</nav>
		</nav>
	</div>
<!-- / .main-navbar -->
<div class="main-content-container container-fluid px-4">