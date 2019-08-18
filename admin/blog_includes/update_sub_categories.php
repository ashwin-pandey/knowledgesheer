<div class="card p-3 mb-3">
	<form method="POST">
		<div class="form-group">
			<label>Edit Sub Category</label>
			<?php

			if(isset($_GET['edit_sub'])){
				$sub_cat_id = escape($_GET['edit_sub']);
				$query = "SELECT * FROM sub_categories WHERE sub_cat_id = $sub_cat_id ";
				$select_category_id = query($query);

				while($row = mysqli_fetch_assoc($select_category_id)) {
					$sub_cat_id = $row['sub_cat_id'];
					$sub_cat_title = $row['sub_cat_title'];
					$parent_cat_id = $row['parent_cat_id'];

					?>
					<input value="<?php echo $sub_cat_title; ?>" type="text" class="form-control" name="sub_cat_title">
				</div>
				<div class="form-group">
					<label>Parent Category</label>
					<select name="parent_id" class="form-control">

						<?php  

						$query = "SELECT * FROM categories";
						$select_parent = query($query);
						while ($row = mysqli_fetch_assoc($select_parent)) {
							$parent_title = $row['cat_title'];
							$parent_id = $row['cat_id'];
							if ($parent_id == $parent_cat_id) {
								echo "<option selected value='$parent_id'>$parent_title</option>";
							} else {
								echo "<option value='$parent_id'>$parent_title</option>";
							}
						}

						?>

					</select>
				</div>
			<?php } } ?>

			<?php updateCategories(); ?>

			<div class="form-group">
				<input class="btn btn-primary btn-sm" name="update_sub_category" type="submit" value="Update"></input>
			</div>

		</form>
	</div>