<?php $current_page = 'users'; include 'partials/admin_header.php'; ?>

<?php 

if (isset($_GET['source'])) {
	$source = $_GET['source'];
} else {
	$source = '';
}

?>

<!-- main content container -->
<div class="container">
	<div class="row">
		<div class="col-12">
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
<!-- main content container -->

<?php include 'partials/admin_footer.php'; ?>