<?php 
include 'includes/db.php';
include './admin/functions.php';

$title = 'Quotes'; 
$page = 'quotes';
include 'partials/header.php'; 
?>

<div class="row quote-posts">
	<div class="col-md-9 col-md-offset-2 col-sm-12 mx-auto col-12">
		<div class="row pt-4">
			<div class="col-md-8 col-12" id="postList">
				<?php
				$query = "SELECT * FROM quotes ORDER BY quote_id DESC LIMIT 7 ";
				$quote = query($query);
				$num_rows = mysqli_num_rows($quote);
				confirmQuery($quote);

				if ($num_rows > 0) {

				while ($row = mysqli_fetch_assoc($quote)) {
				$quote_id = $row['quote_id'];
				$quote_image = $row['quote_image'];
				$quote_content = $row['quote_content'];
				$quote_author = $row['quote_author'];
				$quote_date = $row['quote_date'];

				// User Query
				$query = "SELECT user_id, username, user_firstname, user_lastname, user_image FROM users WHERE username = ? ";
				$stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($stmt, 's', $quote_author);
				mysqli_stmt_execute($stmt);
				confirmQuery($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_image);
				mysqli_stmt_fetch($stmt);

				$full_name = $user_firstname . " " . $user_lastname;
				?>
				<div class="card card-small mb-4">
					<div class="card-header border-0 pb-0">
						<div class="media post-author m-0 mb-2 align-self-center">
							<img style="height: 40px; width: 40px;" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="img-fluid mr-3 mt-0 rounded-circle">
							<div class="media-body align-self-center">
								<div class="user-name">
									<a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $full_name; ?></a>
								</div>
								<div class="date">
									<small style="font-size: 12px;"><?php echo date('F j, Y', strtotime($quote_date)); ?></small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body text-center p-0">
						<img src="assets/images/quote-images/<?php echo $quote_image; ?>" class="img-fluid quote-image" alt="">
					</div>
					<div class="card-footer border-0 quote-content">
						<?php echo $quote_content; ?>
					</div>
				</div>
				<?php } ?>
				<div class="load-more text-center" lastID="<?php echo $quote_id; ?>" style="display: none;">
					<img src="loading.gif"/>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-4 col-12">
				<div class="card">
					<div class="card-body">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'partials/footer.php' ?>