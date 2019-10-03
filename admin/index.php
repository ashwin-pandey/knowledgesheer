<?php 
$title = 'Dashboard';
$current_page = 'index';
include 'partials/admin_header.php'; 

$query = "SELECT * FROM blog_posts";
$select_all_post = query($query);
$blog_post_count = mysqli_num_rows($select_all_post);

$query = 'SELECT * FROM users WHERE user_role = "subscriber"';
$select_all_subscribers = query($query);
$subscriber_count = mysqli_num_rows($select_all_subscribers);

$query = 'SELECT * FROM categories';
$select_all_categories = query($query);
$category_count = mysqli_num_rows($select_all_categories);

$query = 'SELECT * FROM sub_categories';
$select_all_sub_categories = query($query);
$sub_cat_count = mysqli_num_rows($select_all_sub_categories);
?>
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Dashboard</span>
		<h3 class="page-title">Overview</h3>
	</div>
</div>
<!-- End Page Header -->
<!-- Small Stats Blocks -->
<div class="row">
	<div class="col-lg col-md-6 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="stats-small__data text-center">
				<span class="stats-small__label text-uppercase">Blog Posts</span>
				<h6 class="stats-small__value count my-3"><?php echo $blog_post_count; ?></h6>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-6 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="stats-small__data text-center">
				<span class="stats-small__label text-uppercase">Categories</span>
				<h6 class="stats-small__value count my-3"><?php echo $category_count; ?></h6>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="stats-small__data text-center">
				<span class="stats-small__label text-uppercase">Sub-Categories</span>
				<h6 class="stats-small__value count my-3"><?php echo $sub_cat_count; ?></h6>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="stats-small__data text-center">
				<span class="stats-small__label text-uppercase">Comments</span>
				<h6 class="stats-small__value count my-3">0</h6>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-12 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="stats-small__data text-center">
				<span class="stats-small__label text-uppercase">Subscribers</span>
				<h6 class="stats-small__value count my-3"><?php echo $subscriber_count; ?></h6>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <?php include "partials/analytics_report.php"; ?>
</div>

<?php include 'partials/admin_footer.php'; ?>