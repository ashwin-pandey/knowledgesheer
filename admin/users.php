<?php $current_page = 'user'; include 'partials/admin_header.php'; ?>

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
				<?php // $user_page = $source; include 'user_includes/user_navigation.php'; ?>
			</div> -->
			<div class="col-12">
				<div class="blog-main-container">
					
					<!-- switch case for changing pages -->
					<?php 

					switch ($source) {
						case 'add_user':
							include 'user_includes/add_user.php';
							break;

						case 'edit_user':
							include 'user_includes/edit_user.php';
							break;

						case 'view_all_users':
							include 'user_includes/view_all_users.php';
							break;

						case 'user_roles':
							include 'user_includes/user_roles.php';
							break;

						default:
							include 'user_includes/user_dashboard.php';
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