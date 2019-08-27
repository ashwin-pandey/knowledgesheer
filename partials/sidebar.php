<div class="card card-small mb-4">
	<div class="card-body p-0">
		<form action="search.php" class="search-bar" method="POST">
			<div class="input-group md-3">
				<input type="text" class="form-control border-0" placeholder="Search Knowledge Sheer">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" name="search" type="submit"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Categories -->

<div class="card card-small sidebar-categories border-1 mb-3">
	<div class="m-0 p-2 card-title border-bottom mb-2">All Categories</div>
	<div class="card-body p-2">
		<?php 
		$query = 'SELECT * FROM categories';
		$categories = query($query);
		confirmQuery($categories);
		while ($row = mysqli_fetch_assoc($categories)) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			?>
			<h5 class="mb-2 cat-title">
				<a href="category.php?category=<?php echo $cat_id; ?>">
					<?php echo $cat_title; ?>
				</a>
			</h5>
			<hr class="mt-2">
		<?php } ?>
	</div>
</div>