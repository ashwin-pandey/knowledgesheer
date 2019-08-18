<div class="card p-3 mb-3">
	<form method="POST">
		<div class="form-group">
			<label>Edit Parent Category</label>
			<?php

			if(isset($_GET['edit'])){
				$cat_id = escape($_GET['edit']);
				$query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
				$select_category_id = query($query);

				while($row = mysqli_fetch_assoc($select_category_id)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];

					?>
					<input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
				<?php } } ?>
			</div>

			<?php
	// UPDATE QUERY

			if(isset($_POST['update_category'])) {

				$update_cat_title = escape($_POST['cat_title']);
				$update_query = 'UPDATE categories SET cat_title = ? WHERE cat_id = ? ';

				$stmt = mysqli_prepare($connection, $update_query);
				confirmQuery($stmt);
				mysqli_stmt_bind_param($stmt, 'si', $update_cat_title, $cat_id);
				mysqli_stmt_execute($stmt);
				redirect("categories.php");

			}

			?>

			<div class="form-group">
				<input class="btn btn-primary btn-sm" name="update_category" type="submit" value="Update"></input>
			</div>

		</form>
	</div>