<?php 

$title = 'Home'; 
$page = 'home'; 
$home_title = "Home";
$home_description = "Knowledge Sheer is a place to share and spread sheer knowledge on various topics, be it technology, tutorials, pholosophy, management, writing, poems, quotes and many more...";
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>
		<!-- Main Content -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto col-12">
				
				<!-- Quotes Carousel Section -->
				<?php 
				$query = "SELECT quote_id FROM quotes ";
				$count_query = query($query);
				$quote_count = mysqli_num_rows($count_query);
				
				if ($quote_count > 5) {
				?>
				<div class="quote-section">
					<h4>Quotes 
						<small class="float-right">
							<a style="font-size: 15px;" href="<?php echo $baseURL; ?>/quotes.php">(View All)</a>
						</small>
					</h4>
					<hr>
					<div id="quote-carousel" class="owl-carousel owl-theme">
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
						<div class="item">
							<img class="img-fluid" src="<?php echo $baseURL; ?>/assets/images/quote-images/<?php echo $quote_image; ?>" alt="<?php echo $quote_hashtags; ?>">
						</div>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				
				<!-- News Carousel Section -->
				<?php 
				$query = "SELECT post_id, post_title, post_image, post_slug, post_author, post_date, post_content FROM blog_posts WHERE post_category_id = 5 ORDER BY post_id DESC";
				$news_stmt = mysqli_prepare($connection, $query);
				mysqli_stmt_execute($news_stmt);
				confirmQuery($news_stmt);
				mysqli_stmt_store_result($news_stmt);
				mysqli_stmt_bind_result($news_stmt, $news_post_id, $news_post_title, $news_post_image, $news_post_slug, $news_post_author, $news_post_date, $news_post_content);
				$news_count = mysqli_stmt_num_rows($news_stmt);

				if($news_count > 0) {
				?>

				<div class="news-section mt-3">
					<h4>Latest News
						<small class="float-right">
							<a style="font-size: 15px;" href="<?php echo $baseURL; ?>/quotes.php">(View All)</a>
						</small>
					</h4>
					<hr>
					<div id="news-carousel" class="owl-carousel owl-theme">
						<?php 
						while(mysqli_stmt_fetch($news_stmt)) {

							$read_time = read_time($news_post_content);

							$news_post_url = $baseURL . "/blog_post/" . $news_post_id . "/" . $news_post_slug;
							$news_img_url = $baseURL . "/assets/images/blog-images/" . $news_post_image;

							$query = "SELECT user_id, username, user_firstname, user_lastname FROM users WHERE username = ? ";
							$author_stmt = mysqli_prepare($connection, $query);
							mysqli_stmt_bind_param($author_stmt, 's', $news_post_author);
							mysqli_stmt_execute($author_stmt);
							confirmQuery($author_stmt);
							mysqli_stmt_store_result($author_stmt);
							mysqli_stmt_bind_result($author_stmt, $news_user_id, $news_username, $news_firstname, $news_lastname);
							mysqli_stmt_fetch($author_stmt);

							$author_url = $baseURL . "/user_posts/" . $news_username;
							$news_fullname = $news_firstname . " " . $news_lastname;
						
						?>

						<div class="item">
							<div class="card p-0">
								<a href="<?php echo $news_post_url; ?>"><img class="card-img-top img-fluid" src="<?php echo $news_img_url; ?>" alt="<?php echo $news_post_title; ?>"></a>
								<div class="card-body p-2">
									<h5 class="card-title"><a href="<?php echo $news_post_url; ?>"><?php echo substr($news_post_title, 0, 50); ?>...</a></h5>
									<div class="user-post mt-3">
										<div class="media post-author m-0 align-self-center">
											<div class="media-body align-self-center">
												<div class="user-name">
													<a href="<?php echo $author_url; ?>"><?php echo $news_fullname; ?></a>
												</div>
												<div class="date">
													<small><?php echo date('F j, Y', strtotime($news_post_date)); ?> - 
														<?php echo $read_time; ?> min read</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php } ?>
					</div>
				</div>

				<?php } ?>

				<h4 class="mt-4">Blog Posts</h4>
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

					$query = "SELECT post_id, post_title, post_description, post_date, post_author, post_content, post_image, post_category_id, post_slug FROM blog_posts ORDER BY post_id DESC LIMIT ?, ? ";
					$blog_query = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($blog_query, 'ii', $page_1, $per_page);
					mysqli_stmt_execute($blog_query);
					confirmQuery($blog_query);
					mysqli_stmt_store_result($blog_query);
					mysqli_stmt_bind_result($blog_query, $post_id, $post_title, $post_description, $post_date, $post_author, $post_content, $post_image, $post_category_id, $post_slug);

					while (mysqli_stmt_fetch($blog_query)) {
						// Author Query
						$query = "SELECT user_id, username, user_firstname, user_lastname FROM users WHERE username = ? ";
						$user_stmt = mysqli_prepare($connection, $query);
						mysqli_stmt_bind_param($user_stmt, 's', $post_author);
						mysqli_stmt_execute($user_stmt);
						confirmQuery($user_stmt);
						mysqli_stmt_store_result($user_stmt);
						mysqli_stmt_bind_result($user_stmt, $user_id, $username, $user_firstname, $user_lastname);
						mysqli_stmt_fetch($user_stmt);
						$user_full_name = $user_firstname . " " . $user_lastname;

						$post_url = $baseURL . "/blog_post/" . $post_id . "/" . $post_slug;
						$user_url = $baseURL . "/user_posts/" . $username;
						$img_url = $baseURL . "/assets/images/blog-images/" . $post_image;
				?>
	
				<div class="post-preview media">
					<div class="media-body post-body">
						<div class="post-category">
							<?php echo findCategoryTitle($post_category_id); ?>		
						</div>
						<h2 class="post-title">
							<a href="<?php echo $post_url; ?>">
								<?php echo $post_title; ?>
							</a>
						</h2>
						<h3 class="post-subtitle">
						<?php echo substr($post_description, 0, 50) ?>
						</h3>
						<div class="user-post mt-3">
							<div class="media post-author m-0 mb-3 align-self-center">
								<div class="media-body align-self-center">
									<div class="user-name">
										<a href="<?php echo $user_url; ?>"><?php echo $user_full_name; ?></a>
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
						<img class="img-fluid" src="<?php echo $img_url; ?>" alt="<?php echo $post_title; ?>">
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
				
				for($i = 1; $i <= $count; $i++) {
					if($i == $page) {
						echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					} else {
						echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					}
				}

				?>
				</ul>
			</div>
			<div class="col-lg-4 col-md-4 col-12">
				<?php include 'partials/sidebar.php'; ?>
			</div>
 		</div>

<?php include 'partials/footer.php'; ?>