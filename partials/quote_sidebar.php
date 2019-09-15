<div class="card card-small mb-4">
	<div class="card-body p-0">
		<form action="quote_search.php" class="search-bar" method="POST">
			<div class="input-group md-3">
				<input type="text" class="form-control border-0" name="search_input" placeholder="#tags">
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
		$query = 'SELECT quote_cat_id, quote_cat_title FROM quote_categories';
		$categories = query($query);
		confirmQuery($categories);
		while ($row = mysqli_fetch_assoc($categories)) {
			$quote_cat_id = $row['quote_cat_id'];
			$quote_cat_title = $row['quote_cat_title'];
			?>
			<h5 class="mb-2 cat-title">
				<a href="quote_category.php?q_cat_id=<?php echo $quote_cat_id; ?>">
					<?php echo $quote_cat_title; ?>
				</a>
			</h5>
			<hr class="mt-2">
		<?php } ?>
	</div>
</div>