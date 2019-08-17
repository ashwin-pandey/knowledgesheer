<?php 

$title = 'Categories';
$current_page = 'categories';
include 'partials/admin_header.php'; 
?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Dashboard</span>
		<h3 class="page-title">Overview</h3>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<div class="col-4">
		<?php insertCategory(); ?>

		<div class="card p-3 mb-3">
			<form class="" method="POST">
				<div class="form-group">
					<label class="card-title">Add Parent Category</label>
					<div class="form-group">
						<input type="text" class="form-control" name="cat_title" placeholder="Category Title">
					</div>
					<div class="form-group">
						<input type="submit" name="create_category" class="btn btn-sm btn-success">
					</div>
				</div>
			</form>
		</div>
		<div class="card p-3">
			<form class="" method="POST">
				<div class="form-group">
					<label class="card-title">Add Sub Category</label>
					<div class="form-group">
						<input type="text" class="form-control" name="sub_cat_title" placeholder="Sub Category Title">
					</div>
					<div class="form-group">
						<label>Parent</label>
						<select class="form-control" name="parent_id">
							<option value="0">None</option>
							<?php
							$query = 'SELECT * FROM categories';
							$categories = query($query);
							confirmQuery($categories);
							while ($row = mysqli_fetch_assoc($categories)) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];
								echo "<option value='$cat_id'>$cat_title</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="create_sub_category" class="btn btn-sm btn-success">
					</div>
				</div>
			</form>
		</div>

		<?php
		if(isset($_GET['edit'])) {
			$cat_id = $_GET['edit'];
			include "blog_includes/update_categories.php";
		}
		?>
	</div>

	<div class="col-4">
		<div class="card p-3">
			<table class="table border-left border-right card-body table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = 'SELECT * FROM categories';
					$categories = query($query);
					confirmQuery($categories);

					while ($row = mysqli_fetch_assoc($categories)) {
						$cat_id 	= $row['cat_id'];
						$cat_title 	= $row['cat_title'];

						echo "<tr>";
						echo "<td>{$cat_id}</td>";
						echo "<td>{$cat_title}<br>
						<div class='blog-comments__actions'>
							<div class='btn-group btn-group-sm'>
								<button type='button' class='btn btn-white'>
									<a href='categories.php?edit={$cat_id}'>
									<span class='text-light'>
										<i class='material-icons'>edit</i>
									</span> Edit 
									</a>
								</button>
								<button type='button' class='btn btn-white'>
									<a href='categories.php?delete={$cat_id}'>
									<span class='text-danger'>
										<i class='material-icons'>clear</i>
									</span> Delete 
									</a>
								</button>
							</div>
						</div>
						</td>";
						echo "</tr>";
					}

					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-4">
		<div class="card p-3">
			<table class="table border-left border-right card-body table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Parent</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = 'SELECT * FROM sub_categories';
					$sub_categories = query($query);
					confirmQuery($sub_categories);

					while ($row = mysqli_fetch_assoc($sub_categories)) {
						$sub_cat_id 		= $row['sub_cat_id'];
						$sub_cat_title 	= $row['sub_cat_title'];
						$parent_cat_id 	= $row['parent_cat_id'];

						echo "<tr>";
						echo "<td>{$sub_cat_id}</td>";
						echo "<td>{$sub_cat_title}<br>
						<div class='blog-comments__actions'>
							<div class='btn-group btn-group-sm'>
								<button type='button' class='btn btn-white'>
									<a href='categories.php?edit={$cat_id}'>
									<span class='text-light'>
										<i class='material-icons'>edit</i>
									</span> Edit 
									</a>
								</button>
								<button type='button' class='btn btn-white'>
									<a href='categories.php?delete={$cat_id}'>
									<span class='text-danger'>
										<i class='material-icons'>clear</i>
									</span> Delete 
									</a>
								</button>
							</div>
						</div>
						</td>";
						echo "<td>{$parent_cat_id}</td>";
						echo "</tr>";

					}

					?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<?php deleteCategories(); ?>

<?php include 'partials/admin_footer.php'; ?>