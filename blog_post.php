<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['p_id']) && isset($_GET['post_slug'])) {
	$the_post_id = $_GET['p_id'];
	$the_post_slug = $_GET['post_slug'];

	// Post query
	$query = "SELECT post_id, post_title, post_author, post_date, post_category_id, post_sub_cat_id, post_image, post_content, post_tags, post_description, likes, post_slug FROM blog_posts WHERE post_id = ? AND post_status = ? AND post_slug = ? ";
	$stmt1 = mysqli_prepare($connection , $query);
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "iss", $the_post_id, $published, $the_post_slug);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_store_result($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_category_id, $post_sub_cat_id, $post_image, $post_content, $post_tags, $post_description, $likes, $post_slug);
	$stmt = $stmt1;
	$stmt->fetch();
	
	// Author query
	$query = "SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role, user_description FROM users WHERE username = ? ";
	$user_stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($user_stmt, "s", $post_author);
	mysqli_stmt_execute($user_stmt);
	confirmQuery($user_stmt);
	mysqli_stmt_store_result($user_stmt);
	mysqli_stmt_bind_result($user_stmt, $user_id, $username, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $user_description);
	mysqli_stmt_fetch($user_stmt);

	$post_url = $baseURL . "/blog_post/" . $the_post_id . "/" . $post_slug;
	$user_url = $baseURL . "/user_posts/" . $username;
	
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url;
	$twitterURL = 'https://twitter.com/intent/tweet?original_referer=' . $baseURL . '&amp;source=tweetbutton&amp;text=' . $post_title . ';url=' . $post_url . '/&amp;via=Knowledge Sheer';
	$linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_url . '/&media=' . $post_title . '/';
	
	$page = 'blog_post';
	include 'partials/header.php'; 

	?>

	<div class="row">
		<div class="col-md-2">
			<div id="social-icon">
				<div class="heading mb-1">Share this Article</div> <hr class="mb-2 mt-1">
				<ul>
					<li>
						<a target="_blank" class="social-link facebook-social-link" href="<?php echo $facebookURL; ?>" title="Share on Facebook">
							<span class="facebook-social-img">Share</span>
						</a>
					</li>
					<li>
						<a target="_blank" class="social-link twitter-social-link" href="<?php echo $twitterURL; ?>" title="Share on Twitter">
							<span class="twitter-social-img">Share</span>
						</a>
					</li>
					<li>
						<a target="_blank" class="social-link linkedin-social-link" href="<?php echo $linkedinURL; ?>" title="Share on Linkedin">
							<span class="linkedin-social-img">Share</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2 col-12 blog-post">
			<div class="post-title">
				<h1 class="m-0"><?php echo $post_title; ?></h1>
			</div>
			<div class="media post-author align-self-center">
				<img src="<?php echo $baseURL; ?>/assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="mr-3 mt-0 rounded-circle">
				<div class="media-body align-self-center">
					<div class="user-name">
						<a href="<?php echo $user_url; ?>"><?php echo $user_firstname . " " . $user_lastname; ?></a>
					</div>
					<div class="date">
						<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
							<?php echo read_time($post_content); ?> min read</small>
					</div>
				</div>
			</div>
			<?php if (!empty($post_image)) { ?>
			<div class="post-image">
				<img class="img-fluid" src="<?php echo $baseURL; ?>/assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
			</div>
			<?php } ?>

			<div class="post-content pt-4">
				<?php echo stripcslashes($post_content); ?>
			</div>

			<hr>
			
			<div id="share">
			
				<h6>Share this on:</h6>

				<!-- facebook -->
				<a class="facebook" href="<?php echo $facebookURL; ?>" target="blank"><i class="fab fa-facebook-f"></i></a>
				
				<!-- twitter -->
				<a class="twitter" href="<?php echo $twitterURL; ?>" target="blank"><i class="fab fa-twitter"></i></a>
				
				<!-- linkedin -->
				<a class="linkedin" href="<?php echo $linkedinURL; ?>" target="blank"><i class="fab fa-linkedin-in"></i></a>
			
			</div>

			<hr>

			<div class="more-from">
				<!-- <h2 class="mb-4">More from <?php // echo $user_firstname . " " . $user_lastname; ?>:</h2> -->
				<h2 class="mb-4">More from me</h2>
				<?php  

				$query = "SELECT post_id, post_title, post_description, post_image, post_slug FROM blog_posts WHERE post_author = ? ORDER BY post_id DESC LIMIT 3";
				$more_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($more_stmt, 's', $post_author);
				mysqli_stmt_execute($more_stmt);
				mysqli_stmt_store_result($more_stmt);
				mysqli_stmt_bind_result($more_stmt, $more_post_id, $more_post_title, $more_post_description, $more_post_image, $more_post_slug);
				while(mysqli_stmt_fetch($more_stmt)) {
					if ($more_post_id != $the_post_id) {
					$more_post_url = $baseURL . "/blog_post/" . $more_post_id . "/" . $more_post_slug;
					$more_img_url = $baseURL . "/assets/images/blog-images/" . $more_post_image;
					?>

					<div class="row card-body border p-0 mb-4">
						<div class="col-md-4 col-sm-4 col-12 p-0">
							<img class="img-fluid" src="<?php echo $more_img_url; ?>" alt="<?php echo $more_post_title; ?>">
						</div>
						<div class="col-md-8 col-sm-8 col-12 p-3">
							<h4><a href="<?php echo $more_post_url; ?>"><?php echo $more_post_title; ?></a></h4>
							<p><?php echo substr($more_post_description, 0, 50); ?>...</p>
						</div>
					</div>

				<?php } } ?>
			</div>
			
			<hr>

			<ul class="author-info p-0 mt-4">
				<li class="media">
					<img class="img-fluid mr-3 rounded-circle" src="<?php echo $baseURL; ?>/assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $user_firstname . " " . $user_lastname; ?>">
					<div class="media-body align-self-center">
						<p class="mt-0 mb-0 written-by">WRITTEN BY</p>
						<a href="<?php echo $user_url; ?>" class="mb-0 mt-0 user-name"><?php echo $user_firstname . " " . $user_lastname; ?></a>
						<?php if (!empty($user_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($user_description, 0, 50); ?>...</p>
						<?php } ?>
					</div>
				</li>
				<li class="mt-4 media">
					<?php 
					$query = "SELECT cat_id, cat_title, cat_description, cat_image, cat_slug FROM categories WHERE cat_id = ? ";
					$cat_stmt = mysqli_prepare($connection, $query);
					confirmQuery($cat_stmt);
					mysqli_stmt_bind_param($cat_stmt, 'i', $post_category_id);
					mysqli_stmt_execute($cat_stmt);
					mysqli_stmt_store_result($cat_stmt);
					mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_title, $cat_description, $cat_image, $cat_slug);
					$cat_stmt->fetch();
					
					$cat_url = $baseURL . "/category/" . $cat_id . "/" . $cat_slug;

					?>
					<?php if(!empty($cat_image)) { ?>
					<img class="mr-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/<?php echo $cat_image; ?>" alt="<?php echo $cat_title; ?>">
					<?php } else { ?>
					<img class="mr-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/ph-100x100.png" alt="<?php echo $cat_title; ?>">
					<?php } ?>
					<div class="media-body align-self-center">	
						<p class="mt-0 mb-0 written-by">Category</p>
						<a href="<?php echo $cat_url; ?>" class="mb-0 mt-0 user-name"><?php echo $cat_title; ?></a>
						<?php if (!empty($cat_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($cat_description, 0, 50); ?> ...</p>
						<?php } ?>
					</div>
				</li>

				<!-- Show sub category only if not empty -->
				<?php 
				if (!empty($post_sub_cat_id)) {
				?>
				<li class="mt-4 media">
					<?php 

					$query = "SELECT sub_cat_id, sub_cat_title, sub_cat_description, sub_cat_image, sub_cat_slug, parent_cat_id FROM sub_categories WHERE sub_cat_id = ? ";
					$cat_stmt = mysqli_prepare($connection, $query);
					confirmQuery($cat_stmt);
					mysqli_stmt_bind_param($cat_stmt, 'i', $post_sub_cat_id);
					mysqli_stmt_execute($cat_stmt);
					mysqli_stmt_store_result($cat_stmt);
					mysqli_stmt_bind_result($cat_stmt, $sub_cat_id, $sub_cat_title, $sub_cat_description, $sub_cat_image, $sub_cat_slug, $parent_cat_id);
					$cat_stmt->fetch();
					$cat_slug = getCatSlug($parent_cat_id);

					?>
					<?php if(!empty($sub_cat_image)) { ?>
					<img class="mr-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/<?php echo $sub_cat_image; ?>" alt="<?php echo $sub_cat_title; ?>">
					<?php } else { ?>
					<img class="mr-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/ph-100x100.png" alt="<?php echo $cat_title; ?>">
					<?php } ?>
					<div class="media-body align-self-center">	
						<p class="mt-0 mb-0 written-by">Sub Category</p>
						<a href="<?php echo $baseURL; ?>/sub_cat/<?php echo $cat_slug; ?>/<?php echo $sub_cat_id ?>/<?php echo $sub_cat_slug; ?>" class="mb-0 mt-0 user-name"><?php echo $sub_cat_title; ?></a>
						<?php if (!empty($sub_cat_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($sub_cat_description, 0, 50); ?> ...</p>
						<?php } ?>
					</div>
				</li>
				<?php } ?>

			</ul>
		</div>
	</div>
<?php } include './partials/footer.php'; ?>
