<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['p_id'])) {
	$the_post_id = $_GET['p_id'];

	// Post query
	$query = "SELECT post_title, post_author, post_date, post_category_id, post_sub_cat_id, post_image, post_content, post_tags, post_description FROM blog_posts WHERE post_id = ? AND post_status = ? ";
	$stmt1 = mysqli_prepare($connection , $query);
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "is", $the_post_id, $published);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_store_result($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_category_id, $post_sub_cat_id, $post_image, $post_content, $post_tags, $post_description);
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
	
	?>


	<?php 

	$title = $post_title; 
	$page = 'blog_post';
	include 'partials/header.php'; 

	?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto blog-post">
			<div class="post-title">
				<h1 class="m-0"><?php echo $post_title; ?></h1>
			</div>
			<div class="post-author align-self-center">
				<div class="media">
					<img src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="mr-3 mt-0 rounded-circle">
					<div class="media-body align-self-center">
						<div class="user-name">
							<a href="#"><?php echo $user_firstname . " " . $user_lastname; ?></a>
						</div>
						<div class="date">
							<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
								<?php echo read_time($post_content); ?> min read</small>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty($post_image)) { ?>
			<div class="post-image">
				<img class="img-fluid" src="assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
			</div>
			<?php } ?>

			<div class="post-content">
				<?php echo stripcslashes($post_content); ?>
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
				<li>
					<img class="img-fluid mr-3 rounded-circle float-left" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $user_firstname . " " . $user_lastname; ?>">
					<div class="align-self-center ml-5">
						<p class="mt-0 mb-0 written-by">WRITTEN BY</p>
						<a href="user_posts.php?u_id=<?php echo $user_id ?>" class="mb-0 mt-0 user-name"><?php echo $user_firstname . " " . $user_lastname; ?></a>
						<p class="mb-0 mt-0 user-description"><?php echo substr($user_description, 0, 50); ?> ...</p>
					</div>
				</li>
				<li class="mt-4">
					<!-- <img class="img-fluid mr-3 rounded-circle float-left" src="assets/images/profile/<?php // echo $user_image; ?>" alt="<?php // echo $user_firstname . " " . $user_lastname; ?>"> -->

					<?php 

					$query = "SELECT cat_id, cat_title, cat_description FROM categories WHERE cat_id = ? ";
					$cat_stmt = mysqli_prepare($connection, $query);
					confirmQuery($cat_stmt);
					mysqli_stmt_bind_param($cat_stmt, 'i', $post_category_id);
					mysqli_stmt_execute($cat_stmt);
					mysqli_stmt_store_result($cat_stmt);
					mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_title, $cat_description);
					$cat_stmt->fetch();

					?>
					<div class="align-self-center ml-5">
						<p class="mt-0 mb-0 written-by">Category</p>
						<a href="category.php?category=<?php echo $cat_id ?>" class="mb-0 mt-0 user-name"><?php echo $cat_title; ?></a>
						<p class="mb-0 mt-0 user-description"><?php echo substr($cat_description, 0, 50); ?> ...</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
<?php } include './partials/footer.php'; ?>