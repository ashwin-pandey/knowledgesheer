<?php 

$title = 'Home'; 
$page = 'home'; 
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 

?>

<!-- <?php  // include './includes/search_bar.php'; ?> -->

		<!-- Main Content -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto col-12">

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

					$query = 'SELECT * FROM blog_posts ORDER BY post_id DESC LIMIT ' .$page_1. ',' .$per_page;
					$blog_posts = query($query);
					confirmQuery($blog_posts);

					while ($row = mysqli_fetch_assoc($blog_posts)) {
						$post_id = $row['post_id'];
						$post_title = $row['post_title'];
						$post_description = stripcslashes($row['post_description']);
						$post_date = $row['post_date'];
						$post_author = $row['post_author'];
						$post_content = $row['post_content'];
						$post_image = $row['post_image'];
						$post_category_id = $row['post_category_id'];

						// $query = 'SELECT user_firstname, user_lastname FROM users WHERE username='.$post_author;
						// $select_author = query($query);
						// confirmQuery($select_author);
						// $row = mysqli_fetch_assoc($select_author);
						// $user_firstname = $row['user_firstname'];
						// $user_lastname = $row['user_lastname'];
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
						<div class="post-category"><?php echo findCategoryTitle($post_category_id); ?></div>
						<a href="blog_post.php?p_id=<?php echo $post_id; ?>">
							<h2 class="post-title">
							<?php echo $post_title; ?>
							</h2>
						</a>
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
						<img class="img-fluid" src="assets/images/blog-images/<?php echo $post_image; ?>" alt="">
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
				if ($page > 1 && $page <= $count) {
					$p_page = $page - 1;
					echo "<li class='page-item'><a class='page-link' href='index.php?page={$p_page}'><<</a></li>";
				} else {
					$p_page = $page;
					echo "<li class='page-item disabled'><a class='page-link' href='index.php?page={$p_page}'><<</a></li>";
				}
				
				for($i = 1; $i <= $count; $i++) {
					if($i == $page) {
						echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					} else {
						echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
					}
				}

				if ($page < $count && $page >= 1) {
					$p_page = $page + 1;
					echo "<li class='page-item'><a class='page-link' href='index.php?page={$p_page}'>>></a></li>";
				} else {
					$p_page = $page;
					echo "<li class='page-item disabled'><a class='page-link' href='index.php?page={$p_page}'>>></a></li>";
				}

				?>
				</ul>

			</div>
			<div class="col-lg-4 col-md-4 col-12">
				<?php include 'partials/sidebar.php'; ?>
			</div>
 		</div>
<!--	</div>
</div> -->

<?php include 'partials/footer.php'; ?>