<?php
if(isset($_GET['edit_sub'])){
	$the_cat_id = escape($_GET['edit_sub']);
	$query = "SELECT sub_cat_id, sub_cat_title, sub_cat_description, sub_cat_image, sub_cat_slug, parent_cat_id FROM sub_categories WHERE sub_cat_id = ? ";
	$cat = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat, 'i', $the_cat_id);
	mysqli_stmt_execute($cat);
	confirmQuery($cat);
	mysqli_stmt_store_result($cat);
	mysqli_stmt_bind_result($cat, $sub_cat_id, $sub_cat_title, $sub_cat_description, $sub_cat_image, $sub_cat_slug, $parent_cat_id);
	mysqli_stmt_fetch($cat);
	$select_category_id = query($query);
}
if(isset($_POST['update_sub_category'])) {
	$sub_cat_title 			= $_POST['sub_cat_title'];
	$sub_cat_description 	= $_POST['sub_cat_description'];
	$parent_cat_id			= $_POST['parent_id'];
	$sub_cat_slug			= $_POST['sub_cat_slug'];
	$sub_cat_image          = $_FILES['sub_cat_image']['name'];
	$sub_cat_image_temp     = $_FILES['sub_cat_image']['tmp_name'];

	$date = date('m-d-Y');
	$microtime = round(microtime(true));
	$actual_name = pathinfo($sub_cat_image, PATHINFO_FILENAME);
	$ext = pathinfo($sub_cat_image, PATHINFO_EXTENSION);
	$image_path = "../assets/images/cat-images/";
	$prepend_name = 'Img_sub_cat_' . $date . "_" . $microtime;
	$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
	$dest_file = $image_path . $full_img_name;

	move_uploaded_file($sub_cat_image_temp, $dest_file);

	// move_uploaded_file($sub_cat_image_temp, "../assets/images/cat-images/$sub_cat_image");
	if(empty($sub_cat_image)) {
		$query = "SELECT sub_cat_image FROM sub_categories WHERE sub_cat_id = " . $the_cat_id;
		$select_image = query($query);
		confirmQuery($select_image);
		while($row = mysqli_fetch_array($select_image)) {
			$full_img_name = $row['sub_cat_image'];
		}
	}
	$update_query = "UPDATE sub_categories SET sub_cat_title = ?, sub_cat_description = ?, sub_cat_image = ?, sub_cat_slug = ?, parent_cat_id = ? WHERE sub_cat_id = ? ";
	$stmt = mysqli_prepare($connection, $update_query);
	mysqli_stmt_bind_param($stmt, 'ssssii', $sub_cat_title, $sub_cat_description, $full_img_name, $sub_cat_slug, $parent_cat_id, $the_cat_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect($baseURL . "/admin/categories.php");
}
?>
<div class="card p-3 mb-3">
	<form method="POST" enctype="multipart/form-data" action="">
		<div class="form-group">
			<label>Edit Sub Category</label>
			<input value="<?php echo $sub_cat_title; ?>" oninput="convertToSlug(this.value, 'sub-category');" type="text" class="form-control" name="sub_cat_title">
		</div>
		<div class="form-group">
			<input type="text" id="sub-cat-slug" class="form-control" name="sub_cat_slug" value="<?php echo $sub_cat_slug; ?>" required>
		</div>
		<div class="form-group">
			<label>Sub Category</label>
			<select name="parent_id" class="form-control">
				<?php  
				$query = "SELECT cat_id, cat_title FROM categories";
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
		<div class="form-group">
			<textarea name="sub_cat_description" class="form-control" cols="30" rows="10"><?php echo stripslashes($sub_cat_description); ?></textarea>
		</div>
		<div class="form-group">
			<img width="200" src="../assets/images/cat-images/<?php echo $sub_cat_image; ?>">
			<input type="file" id="file-input" class="form-control" name="sub_cat_image">
			<div id="thumb-output" style="width: 235px;"></div>
		</div>
		<div class="form-group">
			<input class="btn btn-primary btn-sm" name="update_sub_category" type="submit" value="Update"></input>
		</div>
	</form>
</div>