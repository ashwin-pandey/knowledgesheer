<form class="" method="POST">

	<div class="form-group">
		<label>Edit Category</label>
		<?php

		if(isset($_GET['edit'])){
			$cat_id = escape($_GET['edit']);
			$query = "SELECT * FROM blog_categories WHERE cat_id = $cat_id ";
			$select_category_id = query($query);

			while($row = mysqli_fetch_assoc($select_category_id)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
				$parent_id = $row['parent_id'];

		?>

		<input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
		
		<?php } } ?>
	</div>
	<div class="form-group">
		<label>Parent</label>
		<select class="form-control" name="parent_id">
			<option value="<?php echo $parent_id ?>">
				<?php
				$query = 'SELECT cat_title FROM blog_categories WHERE cat_id = $parent_id';
				$select_parent_title = query($query);

				while($row = mysqli_fetch_assoc($select_parent_title)) {
					$parent_title = $row['cat_title'];

					echo $parent_title;
				}

				?>
			</option>
			<?php

			$query = "SELECT * FROM blog_categories WHERE cat_id = $cat_id ";
			$blog_categories = query($query);

			while ($row = mysqli_fetch_assoc($blog_categories)) {
				$the_cat_id = $row['cat_id'];
				$the_cat_title = $row['cat_title'];
				$the_parent_id = $row['parent_id'];

				if ($the_cat_id !== $cat_id) {
					echo "<option value='$the_parent_id'>$cat_title</option>";
				}
			}

			?>
		</select>
	</div>

	<?php
	// UPDATE QUERY

	if(isset($_POST['update_category'])) {
		
		$update_cat_title = escape($_POST['cat_title']);
		$update_parent_id = escape($_POST['parent_id']);

		$update_query = 'UPDATE blog_categories SET cat_title = ?, parent_id = ? WHERE cat_id = ? ';

		$stmt = mysqli_prepare($connection, );
		mysqli_stmt_bind_param($stmt, 'si', $update_cat_title, $update_parent_id, $cat_id);
		mysqli_stmt_execute($stmt);

		if(!$stmt){
			die("QUERY FAILED" . mysqli_error($connection));
		}
		mysqli_stmt_close($stmt);
		redirect("blog.php?source=blog_categories");

	}

	?>

	<div class="form-group">
		<input class="btn btn-primary btn-sm" type="submit" value="Update"></input>
	</div>

</form>