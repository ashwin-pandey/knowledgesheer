<?php 

$title = 'Search'; 
$page = 'search'; 
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>
		<!-- Main Content -->
		<div class="row pt-4 search">
			<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto col-12">
				<?php
				if(isset($_POST['search'])){
				$search = $_POST['search_input'];
				$query = "SELECT * FROM blog_posts WHERE post_tags LIKE '%$search%' ";
				$search_query = query($query);
				confirmQuery($search_query);
				$count = mysqli_num_rows($search_query);
				?>
				<h4 class="search-header">Search Results for "<?php echo $search; ?>"</h4>
				<hr>
				<?php
				if($count < 1) {
					echo "<h4 class='text-center'>No posts available</h4>";
				} else {
					while ($row = mysqli_fetch_assoc($search_query)) {
						$post_id = $row['post_id'];
						$post_category_id = $row['post_category_id'];
						$post_title = $row['post_title'];
						$post_description = $row['post_description'];
						$post_author = $row['post_author'];
						$post_content = $row['post_content'];
						$post_image = $row['post_image'];
						$post_date = $row['post_date'];

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
				} }
				?>
				<!-- PAGINATION -->
				<ul class="pagination justify-content-md-center">
				<?php 
				// for($i = 1; $i <= $count; $i++) {
				// 	if($i == $page) {
				// 		echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
				// 	} else {
				// 		echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
				// 	}
				// }
				?>
				</ul>
			</div>
			<div class="col-lg-4 col-md-4 col-12">
				<?php include 'partials/sidebar.php'; ?>
			</div>
 		</div>

<?php include 'partials/footer.php'; ?>