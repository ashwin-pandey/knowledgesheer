<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['u_id'])) {
	$post_user_id = $_GET['u_id'];

	// User Query
	$query = "SELECT user_id, username, user_firstname, user_lastname, user_image, user_description FROM users WHERE user_id = ? ";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'i', $post_user_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_image, $user_description);
	mysqli_stmt_fetch($stmt);

	// Post Query
	$query = "SELECT post_id, post_title, post_author, post_date, post_category_id, post_sub_cat_id, post_image, post_content, post_tags, post_description FROM blog_posts WHERE post_author = ? AND post_status = ? ORDER BY post_id DESC";
	$stmt1 = mysqli_prepare($connection , $query);
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "ss", $username, $published);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_store_result($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_category_id, $post_sub_cat_id, $post_image, $post_content, $post_tags, $post_description);

	$full_name = $user_firstname . " " . $user_lastname;

$title = $full_name; 
$page = 'category';
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>

<div class="row">
	<div class="col-md-7 col-md-offset-2 col-xs-12 mx-auto user-post">
		<ul class="hero-profile">
			<li class="row media">
				<?php if (!empty($user_image)) { ?>
				<img class="align-self-start rounded-circle float-left" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $username; ?>">
				<?php } ?>
				<div class="media-body username align-self-start">
					<h1><?php echo $user_firstname . " " . $user_lastname; ?></h1>
					<div class="description mb-3">
						<p class="m-0"><?php echo $user_description; ?></p>
					</div>
				</div>
			</li>
		</ul>
		<hr>
		<?php while (mysqli_stmt_fetch($stmt1)) { ?>
		<div class="card row user-post-card-body" style="margin-top: 20px;">
			<div class="card-body">
				<div class="media post-author m-0 mb-3 align-self-center">
					<img src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="mr-3 mt-0 rounded-circle">
					<div class="media-body align-self-center">
						<div class="user-name">
							<a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $full_name; ?></a>
						</div>
						<div class="date">
							<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
								<?php echo read_time($post_content); ?> min read</small>
						</div>
					</div>
				</div>
				<div class="user-blog-posts">
					<div class="post-image m-0">
						<img class="img-fluid" src="assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
					</div>
					<div class="post-title mt-4">
						<a href="blog_post.php?p_id=<?php echo $post_id; ?>"><h1 class="m-0"><?php echo $post_title; ?></h1></a>
					</div>
					<div class="post-description">
						<?php echo substr($post_description, 0, 50); ?>
					</div>
					<div class="read-more">
						<a href="blog_post.php?p_id=<?php echo $post_id; ?>">Read More...</a>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>


<?php } include 'partials/footer.php'; ?>