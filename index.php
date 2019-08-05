<?php $title = 'Home'; include 'partials/header.php'; ?>
<?php include './includes/search_bar.php'; ?>

<div class="main-front-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-12">
				<div class="post-list">

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
							$post_image = $row['post_image'];
							$post_date = $row['post_date'];
							$post_author = $row['post_author'];

					?>

					<div class="card border-0 flex-row flex-wrap">
						<div class="card-header border-0 p-0" style="background-color: #fff;">
							<img style="height: 160px; width: 240px;" src="./assets/images/featured/<?php echo $post_image; ?>" alt="">
						</div>
						<div class="card-block px-2 p-3" style="padding-top: 0 !important;">
							<h4 class="card-title"><?php echo stripcslashes($post_title); ?></h4>
							<p><?php echo $post_date. " " .$post_author; ?></p>
							<p class="card-text"><?php echo $post_description; ?></p>
							<a href="#" class="">Read More</a>
						</div>
						<!-- <div class="w-100"></div> -->
					</div>
					<hr>

					<?php 
						}
					} 
					?>

					<ul class="pagination">
					<?php 
					$number_list = array();
					for($i =1; $i <= $count; $i++) {
						if($i == $page) {
							echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
						} else {
							echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
						}
					}
					?>
					</ul>

				</div>
			</div>
			<div class="col-md-4 col-12">
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
	</div>
</div>

<?php include 'partials/footer.php'; ?>