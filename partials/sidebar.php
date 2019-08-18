<div class="card card-small mb-4 mt-4">
<!-- 	<div class="card-header border-bottom">
		<div class="m-0">Search</div>
	</div> -->
	<div class="card-body p-0">
		<form action="search.php" class="search-bar" method="POST">
			<div class="input-group md-3">
				<input type="text" class="form-control" placeholder="Type something...">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" name="search" type="submit"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Categories -->

<div class="card card-small mb-3">
	<div class="m-0 p-2 card-title border-bottom">Categories</div>
	<div class="card-body p-2">
		<?php 
		$query = 'SELECT * FROM categories';
		$categories = query($query);
		confirmQuery($categories);
		while ($row = mysqli_fetch_assoc($categories)) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			?>
			<div class="card mb-1">
				<div class="card-header p-0">
					<h5 class="mb-0">
						<a href="categories.php?cat_id=<?php echo $cat_id; ?>" class="btn btn-link p-2">
							<?php echo $cat_title; ?>
						</a>
					</h5>
				</div>
			</div>
		<?php } ?>
	</div>
</div>