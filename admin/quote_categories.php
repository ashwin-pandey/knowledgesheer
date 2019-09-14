<?php 

$title = 'Quote Categories';
$current_page = 'categories';
include 'partials/admin_header.php'; 
?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Categories</span>
		<h3 class="page-title">Quote</h3>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<div class="col-4">
		<?php insertQuoteCategory(); ?>

		<?php
		if(isset($_GET['edit'])) {
			include "quote_includes/update_quote_categories.php";
		}
		?>

		<div class="card p-3 mb-3">
			<form class="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="card-title">Add New Quote Category</label>
					<div class="form-group">
						<input type="text" class="form-control" oninput="convertToSlug(this.value, 'category');" name="quote_cat_title" placeholder="Quote Category Title" required>
					</div>
					<div class="form-group">
						<input type="text" id="cat-slug" class="form-control" name="quote_cat_slug" placeholder="quote-category-title" required>
					</div>
					<div class="form-group">
						<textarea name="quote_cat_desc" class="form-control" cols="30" rows="10" placeholder="Description"></textarea>
					</div>
					<div class="form-group">
						<input type="file" id="file-input" class="form-control" name="quote_cat_image" required>
						<div id="thumb-output" style="width: 200px;"></div>
					</div>
					<div class="form-group">
						<input type="submit" name="create_quote_category" class="btn btn-sm btn-success">
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="col-4">
		<div class="card p-3">
			<h6>Quote Categories</h6>
			<table class="table border-left border-right border-bottom card-body table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = 'SELECT * FROM quote_categories';
					$categories = query($query);
					confirmQuery($categories);

					while ($row = mysqli_fetch_assoc($categories)) {
						$quote_cat_id 	    = $row['quote_cat_id'];
						$quote_cat_title 	= $row['quote_cat_title'];
						$quote_cat_image 	= $row['quote_cat_image'];
                        $quote_cat_desc 	= $row['quote_cat_desc'];
                        $quote_cat_slug     = $row['quote_cat_slug'];

						echo "<tr>";
						echo "<td>{$quote_cat_id}</td>";
						echo "<td>{$quote_cat_title}<br>
						<div class='blog-comments__actions'>
							<div class='btn-group btn-group-sm'>
								<button type='button' class='btn btn-white'>
									<a href='quote_categories.php?edit={$quote_cat_id}'>
									<span class='text-light'>
										<i class='material-icons'>edit</i>
									</span> Edit 
									</a>
								</button>
							</div>
						</div>
						</td>
						<td class='text-center'><img class='img-fluid' style='height: 46px;' src='../assets/images/quote-cat-images/{$quote_cat_image}'></td>";
						echo "</tr>";
					}

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- <?php // deleteCategories(); ?> -->

<?php include 'partials/admin_footer.php'; ?>