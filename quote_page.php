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
			<div class="col-md-8 col-12">
				<?php
                if(isset($_GET['q_id'])) {
                $the_quote_id = $_GET['q_id'];
                
				$query = "SELECT quote_id, quote_image, quote_content, quote_author, quote_date, likes FROM quotes WHERE quote_id = " . $the_quote_id . "";
				$quote_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_execute($quote_stmt);
				confirmQuery($quote_stmt);
				mysqli_stmt_store_result($quote_stmt);
				mysqli_stmt_bind_result($quote_stmt, $quote_id, $quote_image, $quote_content, $quote_author, $quote_date, $likes);
				mysqli_stmt_fetch($quote_stmt);
				
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
							<img style="height: 40px; width: 40px;" src="<?php echo $baseURL; ?>/assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $full_name; ?>" class="img-fluid mr-3 mt-0 rounded-circle">
							<div class="media-body align-self-center">
								<div class="user-name">
									<a href="<?php echo $baseURL; ?>/user_posts/<?php echo $username; ?>"><?php echo $full_name; ?></a>
								</div>
								<div class="date">
									<small style="font-size: 12px;"><?php echo date('F j, Y', strtotime($quote_date)); ?></small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body text-center p-0">
						<img src="<?php echo $baseURL; ?>/assets/images/quote-images/<?php echo $quote_image; ?>" class="img-fluid quote-image" alt="">
					</div>
					<div class="card-footer border-0 quote-content">
						<a href="<?php echo $baseURL; ?>/assets/images/quote-images/<?php echo $quote_image; ?>" style="color: #fff;" class="btn btn-md btn-success" download>
							<i class="fas fa-download"></i>
						</a>
						<br>
						<br>
						<?php echo $quote_content; ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-4 col-12">
				<?php include "partials/quote_sidebar.php" ?>
			</div>
		</div>
	</div>
</div>

<?php include 'partials/footer.php' ?>