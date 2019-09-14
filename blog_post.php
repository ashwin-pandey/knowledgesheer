<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['p_id'])) {
	$the_post_id = $_GET['p_id'];

	// Post query
	$query = "SELECT post_title, post_author, post_date, post_category_id, post_sub_cat_id, post_image, post_content, post_tags, post_description, likes FROM blog_posts WHERE post_id = ? AND post_status = ? ";
	$stmt1 = mysqli_prepare($connection , $query);
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "is", $the_post_id, $published);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_store_result($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_category_id, $post_sub_cat_id, $post_image, $post_content, $post_tags, $post_description, $likes);
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

	$page = 'blog_post';
	include 'partials/header.php'; 

	?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-12 mx-auto blog-post">
			<div class="post-title">
				<h1 class="m-0"><?php echo $post_title; ?></h1>
			</div>
			<div class="media post-author align-self-center">
				<img src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="mr-3 mt-0 rounded-circle">
				<div class="media-body align-self-center">
					<div class="user-name">
						<a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $user_firstname . " " . $user_lastname; ?></a>
					</div>
					<div class="date">
						<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
							<?php echo read_time($post_content); ?> min read</small>
					</div>
				</div>
			</div>
			<?php if (!empty($post_image)) { ?>
			<div class="post-image">
				<img class="img-fluid" src="assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
			</div>
			<?php } ?>

			<div class="post-content pt-4">
				<?php echo stripcslashes($post_content); ?>
			</div>

			<div class="blog-likes m-0">
				<?php if (isLoggedIn()) { 
				$current_user_id = $_SESSION['user_id'];
				// determine if user has already liked this post
				$results = query("SELECT id FROM blog_likes WHERE user_id = $current_user_id AND post_id = " . $the_post_id . "");

				if (mysqli_num_rows($results) == 0 ): ?>
					<!-- user has not yet liked post -->
					<span style="cursor: pointer;" class="like far fa-thumbs-up" data-id="<?php echo $the_post_id; ?>" data-user-id="<?php echo $current_user_id; ?>"></span> 
					<span style="cursor: pointer;" class="unlike hide fas fa-thumbs-up" data-id="<?php echo $the_post_id; ?>" data-user-id="<?php echo $current_user_id; ?>"></span> 
				<?php else: ?>
					<!-- user already likes post -->
					<span style="cursor: pointer;" class="unlike fas fa-thumbs-up" data-id="<?php echo $the_post_id; ?>" data-user-id="<?php echo $current_user_id; ?>"></span> 
					<span style="cursor: pointer;" class="like hide far fa-thumbs-up" data-id="<?php echo $the_post_id; ?>" data-user-id="<?php echo $current_user_id; ?>"></span>
				<?php endif ?>

				<span class="likes_count"><?php echo $likes ?> likes</span>
				<?php } else { ?>
				<div class="default-login-msg">
					Please <a href="login.php">Login</a> to like.
				</div>
				<?php } ?>
			</div>

			<hr>

			<div class="more-from">
				<h2 class="mb-4">More from <?php echo $user_firstname . " " . $user_lastname; ?>:</h2>

				<?php  

				$query = "SELECT post_id, post_title, post_description, post_image FROM blog_posts WHERE post_author = ? ORDER BY post_id DESC LIMIT 3";
				$more_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($more_stmt, 's', $post_author);
				mysqli_stmt_execute($more_stmt);
				mysqli_stmt_store_result($more_stmt);
				mysqli_stmt_bind_result($more_stmt, $more_post_id, $more_post_title, $more_post_description, $more_post_image);
				while(mysqli_stmt_fetch($more_stmt)) {
					if ($more_post_id != $the_post_id) {
					
					?>

					<div class="row card-body border p-0 mb-4">
						<div class="col-md-4 col-sm-4 col-12 p-0">
							<img class="img-fluid" src="assets/images/blog-images/<?php echo $more_post_image; ?>" alt="<?php echo $more_post_title; ?>">
						</div>
						<div class="col-md-8 col-sm-8 col-12 p-3">
							<h4><a href="blog_post.php?p_id=<?php echo $more_post_id; ?>"><?php echo $more_post_title; ?></a></h4>
							<p><?php echo substr($more_post_description, 0, 30); ?> ...</p>
						</div>
					</div>

				<?php } } ?>
			</div>
			
			<hr>

			<ul class="author-info p-0 mt-4">
				<li class="media">
					<img class="img-fluid mr-3 rounded-circle" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $user_firstname . " " . $user_lastname; ?>">
					<div class="media-body align-self-center">
						<p class="mt-0 mb-0 written-by">WRITTEN BY</p>
						<a href="user_posts.php?u_id=<?php echo $user_id ?>" class="mb-0 mt-0 user-name"><?php echo $user_firstname . " " . $user_lastname; ?></a>
						<?php if (!empty($user_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($user_description, 0, 50); ?> ...</p>
						<?php } ?>
					</div>
				</li>
				<li class="mt-4 media">
					<?php 

					$query = "SELECT cat_id, cat_title, cat_description, cat_image FROM categories WHERE cat_id = ? ";
					$cat_stmt = mysqli_prepare($connection, $query);
					confirmQuery($cat_stmt);
					mysqli_stmt_bind_param($cat_stmt, 'i', $post_category_id);
					mysqli_stmt_execute($cat_stmt);
					mysqli_stmt_store_result($cat_stmt);
					mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_title, $cat_description, $cat_image);
					$cat_stmt->fetch();

					?>
					<?php if(!empty($cat_image)) { ?>
					<img class="mr-3 rounded" src="assets/images/cat-images/<?php echo $cat_image; ?>" alt="<?php echo $cat_title; ?>">
					<?php } else { ?>
					<img class="mr-3 rounded" src="assets/images/cat-images/ph-100x100.png" alt="<?php echo $cat_title; ?>">
					<?php } ?>
					<div class="media-body align-self-center">	
						<p class="mt-0 mb-0 written-by">Category</p>
						<a href="category.php?category=<?php echo $cat_id ?>" class="mb-0 mt-0 user-name"><?php echo $cat_title; ?></a>
						<?php if (!empty($cat_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($cat_description, 0, 50); ?> ...</p>
						<?php } ?>
					</div>
				</li>
				<li class="mt-4 media">
					<?php 

					$query = "SELECT sub_cat_id, sub_cat_title, sub_cat_description, sub_cat_image FROM sub_categories WHERE sub_cat_id = ? ";
					$cat_stmt = mysqli_prepare($connection, $query);
					confirmQuery($cat_stmt);
					mysqli_stmt_bind_param($cat_stmt, 'i', $post_sub_cat_id);
					mysqli_stmt_execute($cat_stmt);
					mysqli_stmt_store_result($cat_stmt);
					mysqli_stmt_bind_result($cat_stmt, $sub_cat_id, $sub_cat_title, $sub_cat_description, $sub_cat_image);
					$cat_stmt->fetch();

					?>
					<?php if(!empty($sub_cat_image)) { ?>
					<img class="mr-3 rounded" src="assets/images/cat-images/<?php echo $sub_cat_image; ?>" alt="<?php echo $sub_cat_title; ?>">
					<?php } else { ?>
					<img class="mr-3 rounded" src="assets/images/cat-images/ph-100x100.png" alt="<?php echo $cat_title; ?>">
					<?php } ?>
					<div class="media-body align-self-center">	
						<p class="mt-0 mb-0 written-by">Sub Category</p>
						<a href="category.php?sub_category=<?php echo $sub_cat_id ?>" class="mb-0 mt-0 user-name"><?php echo $sub_cat_title; ?></a>
						<?php if (!empty($sub_cat_description)) { ?>
						<p class="mb-0 mt-0 user-description"><?php echo substr($sub_cat_description, 0, 50); ?> ...</p>
						<?php } ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
<?php } include './partials/footer.php'; ?>