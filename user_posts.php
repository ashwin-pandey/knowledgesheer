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
	confirmQuery($stmt);
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
					<h1><?php echo $user_firstname . " " . $user_lastname; ?><small>(<?php echo $username; ?>)</small></h1>
					<div class="description mb-3">
						<p class="m-0"><?php echo stripslashes($user_description); ?></p>
					</div>
				</div>
			</li>
		</ul>
		<hr class="mb-0">


		<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active mr-4" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-table"></i> Blog Posts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="quote-tab" data-toggle="tab" href="#quote" role="tab" aria-controls="quote" aria-selected="false"><i class="fas fa-quote-right"></i> Quotes</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
			<div class="tab-pane fade" id="quote" role="tabpanel" aria-labelledby="quote-tab">
				<div class="row" style="margin-top: 20px;">
					<section class="gallery-block grid-gallery">
						<div class="container">
							<div class="row">
								<?php  

								$query = "SELECT quote_id, quote_image, quote_content, quote_date FROM quotes WHERE quote_author = ? ORDER BY quote_id DESC ";
								$user_quote = mysqli_prepare($connection, $query);
								// confirmQuery($user_quote);
								if($user_quote == false) {
									die("<pre>".mysqli_error($connection).PHP_EOL.$query."</pre>");
								}
								mysqli_stmt_bind_param($user_quote, 's', $username);
								mysqli_stmt_execute($user_quote);
								mysqli_stmt_store_result($user_quote);
								mysqli_stmt_bind_result($user_quote, $quote_id, $quote_image, $quote_content, $quote_date);
								while (mysqli_stmt_fetch($user_quote)) {
								?>
								<div class="col-md-6 item mt-3">
									<a href="quote_page.php?q_id=<?php echo $quote_id; ?>"><img class="img-fluid image scale-on-hover" src="assets/images/quote-images/<?php echo $quote_image ?>"></a>
								</div>
								<?php } ?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>

<?php } include 'partials/footer.php'; ?>