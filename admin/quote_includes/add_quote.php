<?php 

if (isset($_POST['create_quote'])) {
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
	$quote_author = $_SESSION['username'];

	$query = "INSERT INTO quotes(quote_image, quote_hashtags, quote_content, quote_author, quote_date) VALUES (?, ?, ?, ?, now())";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'ssss', $full_img_name, $tags, $quote_content, $quote_author);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	redirect($baseURL . "/admin/quotes.php?source=view_all_quotes");
}

?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Quotes</span>
		<h3 class="page-title">Add New Quote</h3>
	</div>
</div>

<!-- End Page Header -->
<form method="POST" action="" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="card card-small">
				<div class="card-body">
					<div class="form-group">
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
						<textarea name="quote_content" cols="30" rows="5" class="form-control" placeholder="Keep #calm and #write something..."></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="create_quote" class="btn btn-primary" value="Create">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>