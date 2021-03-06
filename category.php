<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['category']) && isset($_GET['cat_slug'])) {
	$post_category_id = $_GET['category'];
	$the_cat_slug = $_GET['cat_slug'];

	$query = "SELECT * FROM categories WHERE cat_id = ? AND cat_slug = ? ";
	$cat_stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat_stmt, "is", $post_category_id, $the_cat_slug);
	mysqli_stmt_execute($cat_stmt);
	confirmQuery($cat_stmt);
	mysqli_stmt_store_result($cat_stmt);
	mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_title, $cat_description, $cat_image, $cat_slug);
	mysqli_stmt_fetch($cat_stmt);

	$cat_url = $baseURL . "/category/" . $post_category_id . "/" . $cat_slug;
/*
	$sub_cat_url = "<?php echo $baseURL; ?>/sub_cat/<?php echo $cat_slug; ?>/<?php echo $sub_cat_id ?>/<?php echo $sub_cat_slug; ?>";
*/
$page = 'category';
include 'partials/header.php';

?>

<!-- Main Content -->
<div class="row pt-4">
	<div class="col-lg-3 col-md-3 col-12 category-page text-center">
		<div class="card cat-card border-1 mb-4">
			<div class="card-body">
				<?php if (!empty($cat_image)) { ?>
					<img class="img-fluid rounded mb-3" src="<?php echo $baseURL; ?>/assets/images/cat-images/<?php echo $cat_image; ?>" alt="<?php $cat_title; ?>">
				<?php } else { ?>
					<img class="img-fluid mb-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/ph-100x100.png" alt="<?php $cat_title; ?>">
				<?php } ?>
				<div class="cat-title">
					<h2><?php echo $cat_title; ?></h2>
				</div>
				<div class="cat-desc">
					<?php echo $cat_description; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-12">
		<?php
		$post_query_count = "SELECT * FROM blog_posts WHERE post_status = 'public' AND post_category_id = ".$post_category_id;
		$find_count = query($post_query_count);
		$count = mysqli_num_rows($find_count);
		if($count < 1) {
			echo "<h5 class='text-center'>No posts available</h5>";
		} else {
			$query = 'SELECT * FROM blog_posts WHERE post_category_id = ' .$post_category_id .' ORDER BY post_id DESC';
			$blog_posts = query($query);
			confirmQuery($blog_posts);
			while ($row = mysqli_fetch_assoc($blog_posts)) {
				$post_id = $row['post_id'];
				$post_title = $row['post_title'];
				$post_description = stripcslashes($row['post_description']);
				$post_date = $row['post_date'];
				$post_author = $row['post_author'];
				$post_content = $row['post_content'];
				$post_slug = $row['post_slug'];
				$post_image = $row['post_image'];
				$post_category_id = $row['post_category_id'];

				// User Query
				$query = "SELECT user_id, username, user_firstname, user_lastname FROM users WHERE username = ? ";
				$user_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($user_stmt, 's', $post_author);
				mysqli_stmt_execute($user_stmt);
				confirmQuery($user_stmt);
				mysqli_stmt_store_result($user_stmt);
				mysqli_stmt_bind_result($user_stmt, $user_id, $username, $user_firstname, $user_lastname);
				mysqli_stmt_fetch($user_stmt);
				$user_full_name = $user_firstname . " " . $user_lastname;
		?>
		<div class="post-preview media">
			<div class="media-body post-body">
				<div class="post-category">
					<?php echo findCategoryTitle($post_category_id); ?>		
				</div>
				<h2 class="post-title">
					<a href="<?php echo $baseURL; ?>/blog_post/<?php echo $post_id; ?>/<?php echo $post_slug; ?>">
					<?php echo $post_title; ?>
					</a>
				</h2>
				
				<h3 class="post-subtitle">
				<?php echo substr($post_description, 0, 30) ?>
				</h3>
				<div class="user-post mt-3">
					<div class="media post-author m-0 mb-3 align-self-center">
						<div class="media-body align-self-center">
							<div class="user-name">
								<a href="<?php echo $baseURL; ?>/user_posts/<?php echo $username; ?>"><?php echo $user_full_name; ?></a>
							</div>
							<div class="date">
								<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
									<?php echo read_time($post_content); ?> min read</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty($post_image)) { ?>
			<div class="blog-post-image align-self-start">
				<img class="img-fluid" src="<?php echo $baseURL; ?>/assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
			</div>
			<?php } ?>
		</div>
		<hr>
		<?php } ?>
	</div>
	<div class="col-lg-3 col-md-3 col-12">
		<?php include "partials/cat_sidebar.php"; } ?>
	</div>
</div>
<?php 
} 
if (isset($_GET['sub_category']) && isset($_GET['sub_cat_slug'])) {
	$post_sub_cat_id = $_GET['sub_category'];
	$the_sub_slug = $_GET['sub_cat_slug'];

	$query = "SELECT sub_cat_id, sub_cat_title, sub_cat_description, sub_cat_image, parent_cat_id, sub_cat_slug FROM sub_categories WHERE sub_cat_id = ? AND sub_cat_slug = ? ";
	$cat_stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat_stmt, "is", $post_sub_cat_id, $the_sub_slug);
	mysqli_stmt_execute($cat_stmt);
	confirmQuery($cat_stmt);
	mysqli_stmt_store_result($cat_stmt);
	mysqli_stmt_bind_result($cat_stmt, $sub_cat_id, $sub_cat_title, $sub_cat_description, $sub_cat_image, $parent_cat_id, $sub_cat_slug);
	mysqli_stmt_fetch($cat_stmt);

	$cat_slug = getCatSlug($parent_cat_id);
	$sub_cat_url = $baseURL . "/sub_cat/" . $cat_slug . "/" . $post_sub_cat_id . "/" . $sub_cat_slug;

$page = 'sub_category';
include 'partials/header.php';

?>

<!-- Main Content -->
<div class="row pt-4">
	<div class="col-lg-3 col-md-3 col-12 category-page text-center">
		<div class="card cat-card border-1 mb-4">
			<div class="card-body">
				<?php if (!empty($sub_cat_image)) { ?>
					<img class="img-fluid rounded mb-3" src="<?php echo $baseURL; ?>/assets/images/cat-images/<?php echo $sub_cat_image; ?>" alt="<?php $sub_cat_title; ?>">
				<?php } else { ?>
					<img class="img-fluid mb-3 rounded" src="<?php echo $baseURL; ?>/assets/images/cat-images/ph-100x100.png" alt="<?php $sub_cat_title; ?>">
				<?php } ?>
				<div class="cat-title">
					<h2><?php echo $sub_cat_title; ?></h2>
				</div>
				<div class="cat-desc">
					<?php echo $sub_cat_description; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-12">
		<?php
		$post_query_count = "SELECT * FROM blog_posts WHERE post_status = 'public' AND post_sub_cat_id = ".$post_sub_cat_id;
		$find_count = query($post_query_count);
		$count = mysqli_num_rows($find_count);
		if($count < 1) {
			echo "<h5 class='text-center'>No posts available</h5>";
		} else {
			$query = 'SELECT * FROM blog_posts WHERE post_sub_cat_id = ' .$post_sub_cat_id .' ORDER BY post_id DESC';
			$blog_posts = query($query);
			confirmQuery($blog_posts);
			while ($row = mysqli_fetch_assoc($blog_posts)) {
				$post_id = $row['post_id'];
				$post_title = $row['post_title'];
				$post_description = stripcslashes($row['post_description']);
				$post_date = $row['post_date'];
				$post_author = $row['post_author'];
				$post_content = $row['post_content'];
				$post_image = $row['post_image'];
				$post_slug = $row['post_slug'];
				$post_category_id = $row['post_category_id'];

				// User Query
				$query = "SELECT user_id, username, user_firstname, user_lastname FROM users WHERE username = ? ";
				$user_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($user_stmt, 's', $post_author);
				mysqli_stmt_execute($user_stmt);
				confirmQuery($user_stmt);
				mysqli_stmt_store_result($user_stmt);
				mysqli_stmt_bind_result($user_stmt, $user_id, $username, $user_firstname, $user_lastname);
				mysqli_stmt_fetch($user_stmt);
				$user_full_name = $user_firstname . " " . $user_lastname;
		?>
		<div class="post-preview media">
			<div class="media-body post-body">
				<div class="post-category">
					<?php echo findCategoryTitle($post_category_id); ?>		
				</div>
				<h2 class="post-title">
					<a href="<?php echo $baseURL; ?>/blog_post/<?php echo $post_id; ?>/<?php echo $post_slug; ?>">
					<?php echo $post_title; ?>
					</a>
				</h2>
				
				<h3 class="post-subtitle">
				<?php echo substr($post_description, 0, 30) ?>
				</h3>
				<div class="user-post mt-3">
					<div class="media post-author m-0 mb-3 align-self-center">
						<div class="media-body align-self-center">
							<div class="user-name">
								<a href="<?php echo $baseURL; ?>/user_posts/<?php echo $username; ?>"><?php echo $user_full_name; ?></a>
							</div>
							<div class="date">
								<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
									<?php echo read_time($post_content); ?> min read</small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!empty($post_image)) { ?>
			<div class="blog-post-image align-self-start">
				<img class="img-fluid" src="<?php echo $baseURL; ?>/assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
			</div>
			<?php } ?>
		</div>
		<hr>

		<?php } ?>

	</div>
	<div class="col-lg-3 col-md-3 col-12">
		<div class="card card-small mb-4">
			<div class="card-body p-0">
				<form action="search_category.php" class="search-bar" method="POST">
					<div class="input-group md-3">
						<input type="hidden" name="category_id" value="<?php echo $sub_cat_id; ?>">
						<input type="text" class="form-control border-0" name="search_input" placeholder="Search in '<?php echo $sub_cat_title; ?>'">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" name="sub_cat_search" type="submit"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- Sub Categories -->
		<div class="card card-small sidebar-categories border-1 mb-3">
			<?php  
			$query = "SELECT cat_id, cat_title FROM categories WHERE cat_id = " . $parent_cat_id;
			$parent_cat = query($query);
			while ($row = mysqli_fetch_assoc($parent_cat)) {
				$side_cat_id = $row['cat_id'];
				$side_cat_title = $row['cat_title'];
			?>
			<div class="m-0 p-2 card-title border-bottom mb-2"><?php echo $side_cat_title; ?></div>
			<div class="card-body p-2">
			<?php
				$query = "SELECT * FROM sub_categories WHERE parent_cat_id = " . $side_cat_id;
				$sub_cat = query($query);
				confirmQuery($sub_cat);
				while ($row = mysqli_fetch_assoc($sub_cat)) {
					$sub_id = $row['sub_cat_id'];
					$sub_title = $row['sub_cat_title'];
					$sub_cat_slug = $row['sub_cat_slug'];
					$parent_cat_id = $row['parent_cat_id'];

					$cat_slug = getCatSlug($parent_cat_id);
			?>
				<h5 class="mb-2 cat-title">
					<a href="<?php echo $baseURL; ?>/sub_cat/<?php echo $cat_slug; ?>/<?php echo $sub_cat_id ?>/<?php echo $sub_cat_slug; ?>">
						<?php echo $sub_title; ?>
					</a>
				</h5>
				<hr class="mt-2">
			<?php } ?>
			</div>
		<?php } ?>
		</div>
		<!-- Categories -->
		<div class="card card-small sidebar-categories border-1 mb-3">
			<div class="m-0 p-2 card-title border-bottom mb-2">All Categories</div>
			<div class="card-body p-2">
				<?php 
				$query = 'SELECT * FROM categories';
				$categories = query($query);
				confirmQuery($categories);
				while ($row = mysqli_fetch_assoc($categories)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
					$cat_slug = $row['cat_slug'];

					$cat_url = $baseURL . "/category/" . $cat_id . "/" . $cat_slug;
					?>
					<h5 class="mb-2 cat-title">
						<a href="<?php echo $cat_url; ?>">
							<?php echo $cat_title; ?>
						</a>
					</h5>
					<hr class="mt-2">
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>

<?php } ?>


<?php include 'partials/footer.php'; ?>