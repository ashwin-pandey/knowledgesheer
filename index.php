<?php 

$title = 'Home'; 
$page = 'home'; 
$header_title = 'Clean Blog';
include 'partials/header.php'; 

?>

<!-- <?php  // include './includes/search_bar.php'; ?> -->

		<!-- Main Content -->
		<div class="row">
			<div class="col-lg-8 col-md-8 col-12">

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

						// $query = 'SELECT user_firstname, user_lastname FROM users WHERE username='.$post_author;
						// $select_author = query($query);
						// confirmQuery($select_author);
						// $row = mysqli_fetch_assoc($select_author);
						// $user_firstname = $row['user_firstname'];
						// $user_lastname = $row['user_lastname'];

				?>
	
				<div class="post-preview">
					<a href="blog_post.php?p_id=<?php echo $post_id; ?>">
						<h2 class="post-title">
						Man must explore, and this is exploration at its greatest
						</h2>
						<h3 class="post-subtitle">
						Problems look mighty small from 150 miles up
						</h3>
					</a>
					<p class="post-meta">Posted by
						<a href="#"><?php echo $post_author; ?></a>
						on <?php echo date('F j, Y', strtotime($post_date)); ?>
					</p>
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
				<div class="card flex-wrap">
					<div class="card-header border-0 p-0">
						<img src="//placehold.it/210x160" alt="">
					</div>
					<div class="card-block px-2 p-3">
						<h4 class="card-title">Title</h4>
						<p class="card-text">Description</p>
						<a href="#" class="btn btn-primary">BUTTON</a>
					</div>
				</div>
			</div>
 		</div>
<!--	</div>
</div> -->

<?php include 'partials/footer.php'; ?>