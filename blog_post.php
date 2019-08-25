<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['p_id'])) {
	$the_post_id = $_GET['p_id'];

	// Post query
	$query = "SELECT post_title, post_author, post_date, post_image, post_content, post_tags, post_description FROM blog_posts WHERE post_id = ? AND post_status = ? ";
	$stmt1 = mysqli_prepare($connection , $query);
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "is", $the_post_id, $published);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_store_result($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_description);
	$stmt = $stmt1;
	$stmt->fetch();

	// Author query
	$query = "SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role FROM users WHERE username = ? ";
	$user_stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($user_stmt, "s", $post_author);
	mysqli_stmt_execute($user_stmt);
	confirmQuery($user_stmt);
	mysqli_stmt_store_result($user_stmt);
	mysqli_stmt_bind_result($user_stmt, $user_id, $username, $user_firstname, $user_lastname, $user_email, $user_image, $user_role);
	mysqli_stmt_fetch($user_stmt);
	
	?>


	<?php 

	$title = $post_title; 
	$page = 'blog_post';
	include 'partials/header.php'; 

	?>

	<div class="row">
		<!-- <div class="col-lg-7 col-md-8 mx-auto"> -->
			<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto blog-post">
				<div class="post-title">
					<h1 class="m-0"><?php echo $post_title; ?></h1>
				</div>
				<div class="post-author align-self-center">
					<div class="media">
						<img src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="mr-3 mt-0 rounded-circle" style="">
						<div class="media-body pt-1">
							<div class="user-name">
								<a href="#"><?php echo $user_firstname . " " . $user_lastname; ?></a>
							</div>
							<div class="date">
								<small><?php echo date('F j, Y', strtotime($post_date)); ?></small>
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
					<h2 class="mb-3">More from <?php echo $user_firstname . " " . $user_lastname; ?>:</h2>

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

						<div class="row card-body border p-0 mb-3">
							<div class="col-md-4 col-sm-4 col-12 p-0">
								<img class="img-fluid" src="assets/images/blog-images/<?php echo $more_post_image; ?>" alt="<?php echo $more_post_title; ?>">
							</div>
							<div class="col-md-8 col-sm-8 col-12 p-2">
								<h4><a href="blog_post.php?p_id=<?php echo $more_post_id; ?>"><?php echo $more_post_title; ?></a></h4>
								<p><?php echo $more_post_description; ?></p>
							</div>
						</div>

					<?php } } ?>
				</div>
				
				<hr>

				<div class="row">
					
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2 col-xs-12 mx-auto">

			</div>
		</div>
<?php } include './partials/footer.php'; ?>