<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_POST['quote_cat_search'])) {
	$post_category_id = $_POST['category_id'];
	$search = $_POST['search_input'];
	$query = "SELECT * FROM quote_categories WHERE quote_cat_id = ? ";
	$cat_stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat_stmt, "i", $post_category_id);
	mysqli_stmt_execute($cat_stmt);
	confirmQuery($cat_stmt);
	mysqli_stmt_store_result($cat_stmt);
	mysqli_stmt_bind_result($cat_stmt, $quote_cat_id, $quote_cat_title, $quote_cat_desc, $quote_cat_image, $quote_cat_slug);
	mysqli_stmt_fetch($cat_stmt);

$page = 'quotes';
include 'partials/header.php';

?>

<!-- Main Content -->
<div class="row pt-4">
	<div class="col-lg-3 col-md-3 col-12 category-page text-center">
		<div class="card cat-card border-1 mb-4">
			<div class="card-body">
				<?php if (!empty($quote_cat_image)) { ?>
					<img class="img-fluid rounded mb-3" src="assets/images/quote-cat-images/<?php echo $quote_cat_image; ?>" alt="<?php $quote_cat_title; ?>">
				<?php } else { ?>
					<img class="img-fluid mb-3 rounded" src="assets/images/quote-cat-images/ph-100x100.png" alt="<?php $quote_cat_title; ?>">
				<?php } ?>
				<div class="cat-title">
					<h2><?php echo $quote_cat_title; ?></h2>
				</div>
				<div class="cat-desc">
					<?php echo $quote_cat_desc; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-12">
        <h5 style="font-weight: 500;">Search results for "<?php echo $search; ?>"</h5>
		<hr>
        <?php
		$post_query_count = "SELECT * FROM quotes WHERE quote_category = ".$post_category_id. " AND quote_hashtags LIKE '%$search%' ORDER BY quote_id";
		$find_count = query($post_query_count);
		$count = mysqli_num_rows($find_count);
		if($count < 1) {
			echo "<h5 class='text-center'>No thoughts available</h5>";
		} else {
			while ($row = mysqli_fetch_assoc($find_count)) {
				$quote_id = $row['quote_id'];
                $quote_date = $row['quote_date'];
                $quote_hashtags = $row['quote_hashtags'];
				$quote_author = $row['quote_author'];
				$quote_content = $row['quote_content'];
				$quote_image = $row['quote_image'];
				$quote_category = $row['quote_category'];

				// User Query
				$query = "SELECT user_id, user_firstname, user_lastname, user_image FROM users WHERE username = ? ";
				$user_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($user_stmt, 's', $quote_author);
				mysqli_stmt_execute($user_stmt);
				confirmQuery($user_stmt);
				mysqli_stmt_store_result($user_stmt);
				mysqli_stmt_bind_result($user_stmt, $user_id, $user_firstname, $user_lastname, $user_image);
				mysqli_stmt_fetch($user_stmt);
				$user_full_name = $user_firstname . " " . $user_lastname;
		?>
		<!-- <div class="post-preview media"> -->
            <div class="card card-small mb-4">
                <div class="card-header border-0 pb-0">
                    <div class="media post-author m-0 mb-2 align-self-center">
                        <img style="height: 40px; width: 40px;" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $full_name; ?>" class="img-fluid mr-3 mt-0 rounded-circle">
                        <div class="media-body align-self-center">
                            <div class="user-name">
                                <a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $user_full_name; ?></a>
                            </div>
                            <div class="date">
                                <small style="font-size: 12px;"><?php echo date('F j, Y', strtotime($quote_date)); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center p-0">
                    <a style="cursor: pointer;" href="quote_page.php?q_id=<?php echo $quote_id; ?>"><img src="assets/images/quote-images/<?php echo $quote_image; ?>" class="img-fluid quote-image" alt="<?php echo $quote_hashtags; ?>"></a>
                </div>
                <div class="card-footer border-0 quote-content">
                    <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-facebook" style="background-color: #ccc;">
                        <i class="fab fa-facebook-f" style="color: #fff;"></i>
                    </a>
                    <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-twitter" style="background-color: #ccc;">
                        <i class="fab fa-twitter" style="color: #fff;"></i>
                    </a>
                    <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-instagram" style="background-color: #ccc;">
                        <i class="fab fa-instagram" style="color: #fff;"></i>
                    </a>
                    <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-linkedin" style="background-color: #ccc;">
                        <i class="fab fa-linkedin-in" style="color: #fff;"></i>
                    </a>
                    <a href="assets/images/quote-images/<?php echo $quote_image; ?>" style="color: #fff;" class="btn btn-md btn-success" download><i class="fa fa-arrow-down"></i></a>
                    <a href="quote_page.php?q_id=<?php echo $quote_id; ?>" style="color: #fff;" class="btn btn-md btn-primary"><i class="fa fa-arrow-right"></i></a>
                    <br>
                    <br>
                    <?php echo $quote_content; ?>
                </div>
            </div>
		<!-- </div> -->
		<!-- <hr> -->
		<?php } ?>
	</div>
	<div class="col-lg-3 col-md-3 col-12">
        <div class="card card-small mb-4">
			<div class="card-body p-0">
				<form action="quote_cat_search.php" class="search-bar" method="POST">
					<div class="input-group md-3">
						<input type="hidden" name="category_id" value="<?php echo $quote_cat_id; ?>">
						<input type="text" class="form-control border-0" name="search_input" placeholder="Search in '<?php echo $quote_cat_title; ?>'">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" name="quote_cat_search" type="submit"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
        </div>
        <!-- Categories -->
        <div class="card card-small sidebar-categories border-1 mb-3">
            <div class="m-0 p-2 card-title border-bottom mb-2">All Categories</div>
            <div class="card-body p-2">
                <?php 
                $query = 'SELECT quote_cat_id, quote_cat_title FROM quote_categories';
                $categories = query($query);
                confirmQuery($categories);
                while ($row = mysqli_fetch_assoc($categories)) {
                    $quote_cat_id = $row['quote_cat_id'];
                    $quote_cat_title = $row['quote_cat_title'];
                    ?>
                    <h5 class="mb-2 cat-title">
                        <a href="quote_category.php?q_cat_id=<?php echo $quote_cat_id; ?>">
                            <?php echo $quote_cat_title; ?>
                        </a>
                    </h5>
                    <hr class="mt-2">
                <?php } ?>
            </div>
        </div>
	</div>
</div>

<?php } } include 'partials/footer.php'; ?>