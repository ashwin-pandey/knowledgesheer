<div class="card card-small mb-4">
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
	<div class="card-header border-bottom">
		<div class="m-0">Categories</div>
	</div>
	<div class="card-body p-1">
		<div id="accordion">

			<?php 

			$query = 'SELECT * FROM categories';
			$categories = query($query);
			confirmQuery($categories);

			$query = 'SELECT * FROM sub_categories';
			$sub_categories = query($query);
			confirmQuery($sub_categories);

			while ($row = mysqli_fetch_assoc($categories)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];

				?>


				<div class="card">
					<div class="card-header p-0" id="<?php echo $cat_id ?>">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed p-2" data-toggle="collapse" data-target="#<?php echo $cat_id ?>" aria-expanded="false" aria-controls="<?php echo $cat_id ?>">
								<?php echo $cat_title; ?>
							</button>
						</h5>
					</div>

					<div id="<?php echo $cat_id ?>" class="collapse show" aria-labelledby="<?php echo $cat_id ?>" data-parent="#accordion">
						<div class="card-body p-1">
							<ul class="list-group list-group-flush">
								<li class="list-group-item p-1"><a href="blog.php?cat_id={$cat_id}">All <?php echo $cat_title; ?> posts</a></li>
								<?php  

								$query = 'SELECT * FROM sub_categories WHERE parent_cat_id = '.$cat_id;
								$sub_categories = query($query);
								confirmQuery($sub_categories);

								while ($row = mysqli_fetch_assoc($sub_categories)) {
									$sub_cat_id = $row['sub_cat_id'];
									$sub_cat_title = $row['sub_cat_title'];
									$parent_id = $row['parent_cat_id'];
									echo "<li class='list-group-item p-1'><a href='blog.php?cat_id={$cat_id}&sub_cat_id={$sub_cat_id}'>$sub_cat_title</a></li>";
								}

								?>
							</ul>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
</div>