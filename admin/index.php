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
			<div class="card-body p-0 d-flex">
				<div class="d-flex flex-column m-auto">
					<div class="stats-small__data text-center">
						<span class="stats-small__label text-uppercase">Blog Posts</span>
						<h6 class="stats-small__value count my-3"><?php echo $blog_post_count; ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-6 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="card-body p-0 d-flex">
				<div class="d-flex flex-column m-auto">
					<div class="stats-small__data text-center">
						<span class="stats-small__label text-uppercase">Pages</span>
						<h6 class="stats-small__value count my-3">182</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="card-body p-0 d-flex">
				<div class="d-flex flex-column m-auto">
					<div class="stats-small__data text-center">
						<span class="stats-small__label text-uppercase">Comments</span>
						<h6 class="stats-small__value count my-3">8,147</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-6 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="card-body p-0 d-flex">
				<div class="d-flex flex-column m-auto">
					<div class="stats-small__data text-center">
						<span class="stats-small__label text-uppercase">Users</span>
						<h6 class="stats-small__value count my-3">2,413</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg col-md-4 col-sm-12 mb-4">
		<div class="stats-small stats-small--1 card card-small">
			<div class="card-body p-0 d-flex">
				<div class="d-flex flex-column m-auto">
					<div class="stats-small__data text-center">
						<span class="stats-small__label text-uppercase">Subscribers</span>
						<h6 class="stats-small__value count my-3"><?php echo $subscriber_count; ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'partials/admin_footer.php'; ?>