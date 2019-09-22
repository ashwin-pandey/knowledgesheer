<?php $current_page = 'comments'; include 'partials/admin_header.php'; ?>

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
			<div class="col-3">
				<?php $comments_page = $source; include 'comment_includes/comment_navigation.php'; ?>
			</div>
			<div class="col-9">
				<div class="blog-main-container">
					
					<!-- switch case for changing pages -->
					<?php 

					switch ($source) {
						case 'unapproved_comments':
							include 'comment_includes/unapproved_comments.php';
							break;

						default:
							include 'comment_includes/view_all_comments.php';
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