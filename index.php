<?php 

$title = 'Home'; 
$page = 'home'; 
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>
		<!-- Main Content -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto col-12">
				<?php 
				$query = "SELECT quote_id FROM quotes ";
				$count_query = query($query);
				$quote_count = mysqli_num_rows($count_query);
				
				if ($quote_count > 5) {
				?>
				<h4>Quotes <small class="float-right"><a style="font-size: 15px;" href="quotes.php">(View All)</a></small></h4>
				<hr>
				<div class="owl-carousel owl-theme">
					<?php  
					$query = "SELECT quote_id, quote_author, quote_image, quote_hashtags FROM quotes ORDER BY quote_id DESC LIMIT 5 ";
					$quote_query = query($query);
					confirmQuery($quote_query);
					while ($row = mysqli_fetch_assoc($quote_query)) {
						$quote_id = $row['quote_id'];
						$quote_author = $row['quote_author'];
						$quote_image = $row['quote_image'];
						$quote_hashtags = $row['quote_hashtags'];
					?>
					<div class="item"><img class="img-fluid" src="assets/images/quote-images/<?php echo $quote_image; ?>" alt="<?php echo $quote_hashtags; ?>"></div>
					<?php } ?>
				</div>
				<hr>
				<?php } ?>
				<h4>Blog Posts</h4>
				<hr>

				<?php

				$per_page = 10;

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				} else {
					$page = "";
				}

				if ($page == "" || $page == 1) {
					$page_1 = 0;
				} else {
					$page_1 = ($page * $per_page) - $per_page;
				}

				$post_query_count = "SELECT * FROM blog_posts WHERE post_status = 'public'";

				$find_count = query($post_query_count);
				$count = mysqli_num_rows($find_count);

				if($count < 1) {
					echo "<h1 class='text-center'>No posts available</h1>";
				} else {
					$count  = ceil($count /$per_page);

					$query = "SELECT post_id, post_title, post_description, post_date, post_author, post_content, post_image, post_category_id FROM blog_posts ORDER BY post_id DESC LIMIT ?, ? ";
					$blog_query = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($blog_query, 'ii', $page_1, $per_page);
					mysqli_stmt_execute($blog_query);
					confirmQuery($blog_query);
					mysqli_stmt_store_result($blog_query);
					mysqli_stmt_bind_result($blog_query, $post_id, $post_title, $post_description, $post_date, $post_author, $post_content, $post_image, $post_category_id);

					while (mysqli_stmt_fetch($blog_query)) {
						// Author Query
						$query = "SELECT user_id, user_firstname, user_lastname FROM users WHERE username = ? ";
						$user_stmt = mysqli_prepare($connection, $query);
						mysqli_stmt_bind_param($user_stmt, 's', $post_author);
						mysqli_stmt_execute($user_stmt);
						confirmQuery($user_stmt);
						mysqli_stmt_store_result($user_stmt);
						mysqli_stmt_bind_result($user_stmt, $user_id, $user_firstname, $user_lastname);
						mysqli_stmt_fetch($user_stmt);
						$user_full_name = $user_firstname . " " . $user_lastname;
				?>
	
				<div class="post-preview media">
					<div class="media-body post-body">
						<div class="post-category">
							<?php echo findCategoryTitle($post_category_id); ?>		
						</div>
						<h2 class="post-title">
							<a href="blog_post.php?p_id=<?php echo $post_id; ?>">
							<?php echo $post_title; ?>
							</a>
						</h2>
						<h3 class="post-subtitle">
						<?php echo substr($post_description, 0, 30) ?>
						</h3>
						<div class="user-post mt-3">
							<div class="media post-author m-0 mb-3 align-self-center">
								<div class="media-body align-self-center">
									<div class="user-name">
										<a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $user_full_name; ?></a>
									</div>
									<div class="date">
										<small><?php echo date('F j, Y', strtotime($post_date)); ?> - 
											<?php echo read_time($post_content); ?> min read</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="blog-post-image align-self-start">
						<img class="img-fluid" src="assets/images/blog-images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
					</div>
				</div>
				<hr>
				<?php 
					}
				} 
				?>
				<!-- PAGINATION -->
				<ul class="pagination justify-content-md-center">
				<?php 
				$number_list = array();
				// if ($page > 1 && $page <= $count) {
				// 	$p_page = $page - 1;
				// 	echo "<li class='page-item'><a class='page-link' href='index.php?page={$p_page}'><<</a></li>";
				// } else {
				// 	$p_page = $page;
				// 	echo "<li class='page-item disabled'><a class='page-link' href='index.php?page={$p_page}'><<</a></li>";
				// }
				
				for($i = 1; $i <= $count; $i++) {
					if($i == $page) {
						echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					} else {
						echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					}
				}

				// if ($page < $count && $page >= 1) {
				// 	$p_page = $page + 1;
				// 	echo "<li class='page-item'><a class='page-link' href='index.php?page={$p_page}'>>></a></li>";
				// } else {
				// 	$p_page = $page;
				// 	echo "<li class='page-item disabled'><a class='page-link' href='index.php?page={$p_page}'>>></a></li>";
				// }

				?>
				</ul>
			</div>
			<div class="col-lg-4 col-md-4 col-12">
				<?php include 'partials/sidebar.php'; ?>
			</div>
 		</div>

<?php include 'partials/footer.php'; ?>