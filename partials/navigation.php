<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container">
		<a class="navbar-brand" href="index.php">Knowledge Sheer</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" href="about.html">About</a>
				</li> -->
				<?php if (isLoggedIn()) { ?>
					<?php if (is_admin($_SESSION['username'])) { ?>
						<li class="nav-item"><a class="nav-link" href="/knowledgesheer/admin/">Dashboard</a></li>
					<?php } ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" style="text-transform: none;" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
							<?php echo $_SESSION['username']; ?>
						</a>
						<div class="dropdown-menu dropdown-menu-small">
							<a class="dropdown-item" href="/knowledgesheer/includes/logout.php">Logout</a>
						</div>
					</li>
				<?php } else { ?>
					<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
					<li class="nav-item"><a class="nav-link" href="registration.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<!-- <?php // if ($page == 'blog_post' || $page == 'login' || $page == 'register') { ?> -->
<?php if ($page == 'home') { ?>
	<div class="top-margin"></div>
	<header class="masthead" style="background-image: url('./assets/images/page-headers/home-bg.jpg')">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10 mx-auto">
					<div class="site-heading">
						<h1><?php echo $header_title; ?></h1>
						<span class="subheading">A Simple Blog For Sharing Knowledge</span>
					</div>
				</div>
			</div>
		</div>
	</header>

<?php } else { ?>
	<article>

		<?php } ?>