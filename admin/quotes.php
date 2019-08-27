<?php 
$title = 'Quotes';
$current_page = 'quotes';
include 'partials/admin_header.php'; 

if (isset($_GET['source'])) {
	$source = $_GET['source'];
} else {
	$source = '';
}
?>

<div class="main-content">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="blog-main-container">
					<?php 
					switch ($source) {
						case 'add_quote':
							include 'quote_includes/add_quote.php';
							break;

						case 'edit_quote':
							include 'quote_includes/edit_quote.php';
							break;

						case 'view_all_quotes':
							include 'quote_includes/view_all_quotes.php';
							break;

						default:
							include 'quote_includes/quote_dashboard.php';
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