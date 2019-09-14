<?php 
if(isset($_GET['edit'])){
	$the_cat_id = $_GET['edit'];
	$query = "SELECT * FROM quote_categories WHERE quote_cat_id = ? ";
	$cat = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($cat, 'i', $the_cat_id);
	mysqli_stmt_execute($cat);
	confirmQuery($cat);
	mysqli_stmt_store_result($cat);
	mysqli_stmt_bind_result($cat, $quote_cat_id, $quote_cat_title, $quote_cat_desc, $quote_cat_image, $quote_cat_slug);
	mysqli_stmt_fetch($cat);
	$select_category_id = query($query);
}
if(isset($_POST['update_quote_category'])) {
	$quote_cat_title 		= $_POST['quote_cat_title'];
    $quote_cat_desc 		= $_POST['quote_cat_desc'];
    $quote_cat_slug			= trim($_POST['quote_cat_slug']);
    $quote_cat_image        = escape($_FILES['quote_cat_image']['name']);
    $quote_cat_image_temp   = escape($_FILES['quote_cat_image']['tmp_name']);
    move_uploaded_file($quote_cat_image_temp, "../assets/images/quote-cat-images/$cat_image");

	if(empty($quote_cat_image)) {
		$query = "SELECT quote_cat_image FROM quote_categories WHERE quote_cat_id = " . $the_cat_id;
		$select_image = query($query);
		confirmQuery($select_image);
		while($row = mysqli_fetch_array($select_image)) {
			$quote_cat_image = $row['quote_cat_image'];
		}
	}
	$update_query = "UPDATE quote_categories SET quote_cat_title = ?, quote_cat_desc = ?, quote_cat_image = ?, quote_cat_slug = ? WHERE quote_cat_id = ? ";
	$stmt = mysqli_prepare($connection, $update_query);
	mysqli_stmt_bind_param($stmt, 'ssssi', $quote_cat_title, $quote_cat_desc, $quote_cat_image, $quote_cat_slug, $the_cat_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect("quote_categories.php");
}
?>
<div class="card p-3 mb-3">
	<form method="POST" enctype="multipart/form-data" action="">
		<div class="form-group">
			<label>Edit Category</label>
			<div class="form-group">
				<input value="<?php echo $quote_cat_title; ?>" oninput="convertToSlug(this.value, 'category');" type="text" class="form-control" name="quote_cat_title">
			</div>
			<div class="form-group">
				<input type="text" id="cat-slug" class="form-control" name="quote_cat_slug" value="<?php echo $quote_cat_slug; ?>" required>
			</div>
			<div class="form-group">
				<textarea name="quote_cat_desc" class="form-control" cols="30" rows="10"><?php echo stripslashes($quote_cat_desc); ?></textarea>
			</div>
			<div class="form-group">
				<img width="200" src="../assets/images/quote-cat-images/<?php echo $quote_cat_image; ?>">
				<input type="file" id="file-input" name="quote_cat_image">
				<div id="thumb-output" style="width: 235px;"></div>
			</div>
		</div>
		<div class="form-group">
			<input class="btn btn-primary btn-sm" name="update_quote_category" type="submit" value="Update"></input>
		</div>
	</form>
</div>