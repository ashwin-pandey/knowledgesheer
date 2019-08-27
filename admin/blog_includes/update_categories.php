<?php 
if(isset($_GET['edit'])){
	$the_cat_id = $_GET['edit'];
	$query = "SELECT * FROM categories WHERE cat_id = ? ";
	$cat = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat, 'i', $the_cat_id);
	mysqli_stmt_execute($cat);
	confirmQuery($cat);
	mysqli_stmt_store_result($cat);
	mysqli_stmt_bind_result($cat, $cat_id, $cat_title, $cat_description, $cat_image);
	mysqli_stmt_fetch($cat);
	$select_category_id = query($query);
}
if(isset($_POST['update_category'])) {
	$cat_title 			= $_POST['cat_title'];
	$cat_description 	= $_POST['cat_description'];
	$cat_image          = escape($_FILES['cat_image']['name']);
	$cat_image_temp     = escape($_FILES['cat_image']['tmp_name']);
	move_uploaded_file($cat_image_temp, "../assets/images/cat-images/$cat_image");
	if(empty($cat_image)) {
		$query = "SELECT * FROM categories WHERE cat_id = " . $the_cat_id;
		$select_image = query($query);
		confirmQuery($select_image);
		while($row = mysqli_fetch_array($select_image)) {
			$cat_image = $row['cat_image'];
		}
	}
	$update_query = "UPDATE categories SET cat_title = ?, cat_description = ?, cat_image = ? WHERE cat_id = ? ";
	$stmt = mysqli_prepare($connection, $update_query);
	mysqli_stmt_bind_param($stmt, 'sssi', $cat_title, $cat_description, $cat_image, $the_cat_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect("categories.php");
}
?>
<div class="card p-3 mb-3">
	<form method="POST" enctype="multipart/form-data" action="">
		<div class="form-group">
			<label>Edit Category</label>
			<div class="form-group">
				<input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
			</div>
			<div class="form-group">
				<textarea name="cat_description" class="form-control" cols="30" rows="10"><?php echo stripslashes($cat_description); ?></textarea>
			</div>
			<div class="form-group">
				<img width="200" src="../assets/images/cat-images/<?php echo $cat_image; ?>">
				<input type="file" id="file-input" name="cat_image">
				<div id="thumb-output" style="width: 235px;"></div>
			</div>
		</div>
		<div class="form-group">
			<input class="btn btn-primary btn-sm" name="update_category" type="submit" value="Update"></input>
		</div>
	</form>
</div>