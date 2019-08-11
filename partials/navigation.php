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
				<li class="nav-item">
					<a class="nav-link" href="about.html">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="registration.php">Sign Up</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<?php if ($page == 'blog_post' || $page == 'login' || $page == 'register') { ?>

<!-- <header class="masthead" style="background-image: url('./assets/images/page-headers/post-bg.jpg')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="post-heading">
					<h1><?php // echo stripcslashes($post_title); ?></h1>
					<h2 class="subheading"><?php // echo stripslashes($post_description); ?></h2>
					<span class="meta">Posted by
						<a href="#"><?php // echo stripcslashes($post_author); ?></a>
						on <?php // echo date('F j, Y', strtotime($post_date)); ?>
					</span>
				</div>
			</div>
		</div>
	</div>
</header> -->

<article>

<?php } else { ?>
<div class="top-margin"></div>
<header class="masthead" style="background-image: url('./assets/images/page-headers/home-bg.jpg')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-10 mx-auto">
				<div class="site-heading">
					<h1><?php echo $header_title; ?></h1>
					<span class="subheading">A Blog Theme by Start Bootstrap</span>
				</div>
			</div>
		</div>
	</div>
</header>

<?php } ?>