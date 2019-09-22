<?php 

$title = 'Blog Dashboard';
$current_page = 'blog';
include 'partials/admin_header.php'; ?>

<?php 

if (isset($_GET['source'])) {
	$source = $_GET['source'];
} else {
	$source = '';
}

?>

<!-- main content container -->
<div class="main-content">
	<div class="container">
		<div class="row">
			<!-- <div class="col-3">
				<?php // $blog_page = $source; include 'blog_includes/blog_navigation.php'; ?>
			</div> -->
			<div class="col-12">
				<div class="blog-main-container">
					
					<!-- switch case for changing pages -->
					<?php 

					switch ($source) {
						case 'add_post':
							include 'blog_includes/add_post.php';
							break;

						case 'edit_post':
							include 'blog_includes/edit_post.php';
							break;

						case 'unapproved_posts':
							include 'blog_includes/unapproved_posts.php';
							break;

						case 'view_all_posts':
							include 'blog_includes/view_all_posts.php';
							break;

						case 'blog_categories':
							include 'blog_includes/blog_categories.php';
							break;

						default:
							include 'blog_includes/blog_dashboard.php';
							break;
						}		

					?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- main content container -->

<?php include 'partials/admin_footer.php'; ?>