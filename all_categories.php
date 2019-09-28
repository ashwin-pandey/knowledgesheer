<?php 

$page = 'all_categories'; 
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>
<!-- Main Content -->
<div class="row all-categories">
	<div class="col-md-8 col-md-offset-2 col-12 mx-auto">
		<h5>All Categories</h5> <hr>
		<div class="row">
			<?php  
			$query = "SELECT * FROM categories";
			$cat_stmt = query($query);
			confirmQuery($cat_stmt);
			while ($row = mysqli_fetch_assoc($cat_stmt)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
				$cat_image = $row['cat_image'];
				$cat_slug = $row['cat_slug'];

				$cat_url = $baseURL . "/category/" . $cat_id . "/" . $cat_slug;
				
			?>
				<div class="col-md-4">
					<div class="card card-small mb-3">
						<a class="category-card" style='background-image: url(<?php echo $baseURL; ?>/assets/images/cat-images/<?php echo $cat_image; ?>);' href="<?php echo $cat_url; ?>">
							<div class="card-body pt-5">
								<?php echo $cat_title; ?>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php include "partials/footer.php"; ?>