<?php 

if (isset($_GET['q_id'])) {
    $the_quote_id = $_GET['q_id'];

    $query = "SELECT quote_id, quote_image, quote_content, quote_author, quote_category FROM quotes WHERE quote_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $the_quote_id);
    mysqli_stmt_execute($stmt);
    confirmQuery($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $quote_id, $quote_image, $quote_content, $quote_author, $quote_category);
    mysqli_stmt_fetch($stmt);

}

if (isset($_POST['update_quote'])) {
	// Quote image
	$quote_image 		= escape($_FILES['quote_image']['name']);
	$quote_image_temp	= escape($_FILES['quote_image']['tmp_name']);
    move_uploaded_file($quote_image_temp, "../assets/images/quote-images/$quote_image" );
    
    if (empty($quote_image)) {
        $query = "SELECT quote_image FROM quotes WHERE quote_id = " . $the_quote_id;
        $select_image = query($query);
        confirmQuery($select_image);
        while($row = mysqli_fetch_array($select_image)) {
        	$quote_image = $row['quote_image'];
        }
    }

	// Quote content & hashtags
	$quote_content = $_POST['quote_content'];
	$htag = "#"; $arr = explode(" ", $quote_content); $arrc = count($arr); $i = 0;
	$tags = "";
	while ($i < $arrc) {
		if (substr($arr[$i], 0, 1) === $htag) {
			$par = $arr[$i]; 
			$par = preg_replace("#[^0-9a-z]#i", "", $par);
			$tags .= $par . ", ";
			$arr[$i] = "<a target='_blamk' href='search.php?hashtag={$par}'>" . $arr[$i] . "</a>";
		}	
		$i++;
	}
	$quote_content = implode(" ", $arr);
	// echo $quote_content;
	$quote_category = $_POST['quote_category'];

	$query  = "UPDATE quotes SET ";
	$query .= "quote_image = ?, ";
	$query .= "quote_content = ?, ";
	$query .= "quote_category = ?, ";
	$query .= "quote_hashtags = ? ";
	$query .= "WHERE quote_id = ? ";
		
	$stmt = mysqli_prepare($connection, $query);
	if (!$stmt) {
		die("Query Failed! - " . mysqli_error($connection));
	}
	mysqli_stmt_bind_param($stmt, 'ssisi', $quote_image, $quote_content, $quote_category, $tags, $the_quote_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect("/knowledgesheer/admin/quotes.php?source=view_all_quotes");
}

?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Quotes</span>
		<h3 class="page-title">Edit Quote</h3>
	</div>
</div>

<!-- End Page Header -->
<form method="POST" action="" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="card card-small">
				<div class="card-body">
					<div class="form-group">
                        <img class="img-fluid" src="../assets/images/quote-images/<?php echo $quote_image; ?>" alt="">
						<input type="file" id="file-input" name="quote_image" class="form-control">
						<div id="thumb-output"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-small">
				<div class="card-body">
					<div class="form-group">
						<select name="quote_category" class="form-control">
							<option value="">select category</option>
							<?php

								$query = "SELECT quote_cat_id, quote_cat_title FROM quote_categories ";
								$select_categories = query($query);

								confirmQuery($select_categories);

								while($row = mysqli_fetch_assoc($select_categories )) {
									$quote_cat_id = $row['quote_cat_id'];
									$quote_cat_title = $row['quote_cat_title'];

									if($quote_cat_id == $quote_category) {
										echo "<option selected value='{$quote_cat_id}'>{$quote_cat_title}</option>";
									} else {
										echo "<option value='{$quote_cat_id}'>{$quote_cat_title}</option>";
									}
								}

							?>
						</select>
					</div>
					<div class="form-group">
						<textarea name="quote_content" cols="30" rows="5" class="form-control"><?php echo strip_tags($quote_content); ?></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="update_quote" class="btn btn-primary" value="Update">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>