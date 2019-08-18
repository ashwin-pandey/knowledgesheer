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
					$cat_description = $row['cat_description'];

					?>
					<input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
					<textarea name="cat_description" class="form-control" cols="30" rows="10">
						<?php echo stripslashes($cat_description); ?>
					</textarea>
				<?php } } ?>
			</div>

			<?php updateCategories(); ?>

			<div class="form-group">
				<input class="btn btn-primary btn-sm" name="update_category" type="submit" value="Update"></input>
			</div>

		</form>
	</div>