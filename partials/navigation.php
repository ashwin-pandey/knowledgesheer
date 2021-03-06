<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand" href="<?php echo $baseURL; ?>/index">Knowledge Sheer</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link <?php if($page == 'home'){ echo 'active-nav'; } else { echo ''; } ?>" href="<?php echo $baseURL; ?>/index">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if($page == 'quotes'){ echo 'active-nav'; } else { echo ''; } ?>" href="<?php echo $baseURL; ?>/quotes">Quotes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if($page == 'all_categories' || $page == 'category' || $page == 'sub_category'){ echo 'active-nav'; } else { echo ''; } ?>" href="<?php echo $baseURL; ?>/all_categories">Categories</a>
				</li>
				<?php if (isLoggedIn()) { ?>
					<?php if (is_admin($_SESSION['username']) || is_editor($_SESSION['username'])) { ?>
						<li class="nav-item"><a class="nav-link" href="<?php echo $baseURL; ?>/admin/">Dashboard</a></li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" style="text-transform: none;" href="<?php echo $baseURL; ?>/profile"><?php echo $_SESSION['username']; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo $baseURL; ?>/includes/logout.php">Logout</a>
					</li>
				<?php } else { ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo $baseURL; ?>/login">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo $baseURL; ?>/registration">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<?php if ($page == 'home') { ?>
	<div class="top-margin"></div>
	<header class="masthead" style="background-image: url('<?php echo $baseURL; ?>/assets/images/page-headers/home-bg.jpg')">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					<div class="site-heading">
						<h1><?php echo $header_title; ?></h1>
						<span class="subheading">A Place For Sharing Knowledge</span>
					</div>
				</div>
			</div>
		</div>
	</header>

<?php } else { ?>
	<article>

		<?php } ?>
