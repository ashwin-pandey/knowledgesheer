<?php 

if (isset($_GET['q_id'])) {
    $the_quote_id = $_GET['q_id'];

    $query = "SELECT quote_id, quote_image, quote_content, quote_author FROM quotes WHERE quote_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $the_quote_id);
    mysqli_stmt_execute($stmt);
    confirmQuery($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $quote_id, $quote_image, $quote_content, $quote_author);
    mysqli_stmt_fetch($stmt);

}

if (isset($_POST['update_quote'])) {
	// Quote image
	$quote_image 		= escape($_FILES['quote_image']['name']);
	$quote_image_temp	= escape($_FILES['quote_image']['tmp_name']);

	$date = date('m-d-Y');
	$microtime = round(microtime(true));
	$actual_name = pathinfo($quote_image, PATHINFO_FILENAME);
	$ext = pathinfo($quote_image, PATHINFO_EXTENSION);
	$image_path = "../assets/images/quote-images/";
	$prepend_name = 'Img_quote_' . $date . "_" . $microtime;
	$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
	$dest_file = $image_path . $full_img_name;

	move_uploaded_file($quote_image_temp, $dest_file);

    // move_uploaded_file($quote_image_temp, "../assets/images/quote-images/$quote_image" );
    
    if (empty($quote_image)) {
        $query = "SELECT quote_image FROM quotes WHERE quote_id = " . $the_quote_id;
        $select_image = query($query);
        confirmQuery($select_image);
        while($row = mysqli_fetch_array($select_image)) {
        	$full_img_name = $row['quote_image'];
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
			$arr[$i] = "<a target='_blamk' href='quote_search.php?q_search={$par}'>" . $arr[$i] . "</a>";
		}	
		$i++;
	}
	$quote_content = implode(" ", $arr);
	// echo $quote_content;
	$quote_category = $_POST['quote_category'];

	$query  = "UPDATE quotes SET ";
	$query .= "quote_image = ?, ";
	$query .= "quote_content = ?, ";
	$query .= "quote_hashtags = ? ";
	$query .= "WHERE quote_id = ? ";
		
	$stmt = mysqli_prepare($connection, $query);
	if (!$stmt) {
		die("Query Failed! - " . mysqli_error($connection));
	}
	mysqli_stmt_bind_param($stmt, 'sssi', $full_img_name, $quote_content, $tags, $the_quote_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect("<?php echo $baseURL; ?>/admin/quotes.php?source=view_all_quotes");
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
			<div class="card card-small mb-3">
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