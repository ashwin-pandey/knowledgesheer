<div class="container">
	<h6>Blog Categories</h6>
	<hr>
	<div class="row">
		<div class="col-4">
			<?php insertCategory(); ?>
			<form class="" method="POST">
				<div class="form-group">
					<label>Add New Category</label>
					<div class="form-group">
						<input type="text" class="form-control blog_cat_title" name="cat_title" placeholder="Category Title">
					</div>
					<div class="form-group">
						<label>Parent</label>
						<select class="form-control" name="parent_id">
							<option value="0">None</option>
							<?php

							$query = 'SELECT * FROM blog_categories';
							$blog_categories = query($query);
							confirmQuery($blog_categories);

							while ($row = mysqli_fetch_assoc($blog_categories)) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];

								echo "<option value='$cat_id'>$cat_title</option>";
							}

							?>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="create_category" class="btn btn-sm btn-success">
					</div>
				</div>
			</form>

			<?php

			if(isset($_GET['edit'])) {
				$cat_id = $_GET['edit'];
				include "blog_includes/update_categories.php";
			}

			?>

		</div>

		<div class="col-8">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Parent</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$query = 'SELECT * FROM blog_categories';
					$blog_categories = query($query);
					confirmQuery($blog_categories);

					while ($row = mysqli_fetch_assoc($blog_categories)) {
						$cat_id 	= $row['cat_id'];
						$cat_title 	= $row['cat_title'];
						$parent_id 	= $row['parent_id'];

						echo "<tr>";
						echo "<td>{$cat_id}</td>";
						echo "<td>{$cat_title}</td>";
						echo "<td>{$parent_id}</td>";
						echo "<td><a href='blog.php?source=blog_categories&edit={$cat_id}'>Edit</a></td>";
						echo "<td><a href='blog.php?source=blog_categories&delete={$cat_id}'>Delete</a></td>";
						echo "</tr>";
					}

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php deleteCategories(); ?>