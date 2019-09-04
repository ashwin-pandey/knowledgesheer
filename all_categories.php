<?php 

$page = 'all_categories'; 
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>
<!-- Main Content -->
<div class="row all-categories">
	<div class="col-md-10 col-md-offset-2 col-xs-12 mx-auto col-12">
		<div class="row">
			<?php  
			$query = "SELECT cat_id, cat_title, cat_image FROM categories";
			$cat_stmt = query($query);
			confirmQuery($cat_stmt);
			while ($row = mysqli_fetch_assoc($cat_stmt)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
				$cat_image = $row['cat_image'];
			?>
				<div class="col-md-4">
					<div class="card card-small">
						<a class="category-card" style='background-image: url(assets/images/cat-images/<?php echo $cat_image; ?>);' href="category.php?category=<?php echo $cat_id; ?>">
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