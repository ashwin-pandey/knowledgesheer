<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Blog Posts</span>
		<?php if (is_editor($_SESSION['username'])) { ?>
			<h3 class="page-title"><i><?php echo $_SESSION['firstname']; ?>'s</i> Posts </h3>
		<?php } else { ?>
			<h3 class="page-title">View All Posts</h3>
		<?php } ?>
	</div>
</div>
<!-- End Page Header -->

<!-- Default Light Table -->
<div class="row">
	<div class="col">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<div class="row">
					<div class="col-12">
						<h5 class="card-title float-left">All Blog Posts</h5>
						<a class="btn btn-primary float-right" href="posts.php?source=add_post">Add New</a>
					</div>
				</div>
			</div>
			<div class="card-body pb-3 text-left">
				<table class="table table-striped table-bordered" style="width: 100%;" id="view_all_posts">
					<thead class="bg-light">
						<tr>
							<th>Author</th>
							<th>Title</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Likes</th>
							<th>Slug</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if (is_editor($_SESSION['username'])) {
							$query = "SELECT post_id, post_author, post_title, post_category_id, post_sub_cat_id, post_status, post_tags, post_date, likes, post_slug FROM blog_posts WHERE post_author = ? ORDER BY post_id DESC";
							$stmt = mysqli_prepare($connection, $query);
							mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
						} else {
							$query = "SELECT post_id, post_author, post_title, post_category_id, post_sub_cat_id, post_status, post_tags, post_date, likes, post_slug FROM blog_posts ORDER BY post_id DESC ";
							$stmt = mysqli_prepare($connection, $query);
						}
						mysqli_stmt_execute($stmt);
						confirmQuery($stmt);
						mysqli_stmt_store_result($stmt);
						mysqli_stmt_bind_result($stmt, $post_id, $post_author, $post_title, $post_category_id, $post_sub_cat_id, $post_status, $post_tags, $post_date, $likes, $post_slug);
						
						while(mysqli_stmt_fetch($stmt)) {

							echo "<tr>";

							echo "<td>$post_author</td>";
							echo "<td>
							$post_title -- <b>$post_status</b><br>

							<div class='blog-comments__actions'>
								<div class='btn-group btn-group-sm'>
									<button type='button' class='btn btn-white'>
										<a href='../blog_post.php?p_id={$post_id}' target='_blank'>
										<span class='text-light'>
											<i class='material-icons'>remove_red_eye</i>
										</span> View 
										</a>
									</button>
									<button type='button' class='btn btn-white'>
										<a href='blog.php?source=edit_post&p_id={$post_id}'>
										<span class='text-light'>
											<i class='material-icons'>edit</i>
										</span> Edit 
										</a>
									</button>
								</div>
							</div>
							</td>";

							$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
							$select_categories_id = query($query);  

							while($row = mysqli_fetch_assoc($select_categories_id)) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];


								echo "<td>$cat_title</td>";

							}

							$query = "SELECT * FROM sub_categories WHERE sub_cat_id = {$post_sub_cat_id} ";
							$select_sub_categories_id = query($query);  

							while($row = mysqli_fetch_assoc($select_sub_categories_id)) {
								$sub_cat_id = $row['sub_cat_id'];
								$sub_cat_title = $row['sub_cat_title'];

								echo "<td>$sub_cat_title</td>";
							}

							echo "<td>$post_tags</td>";
							echo "<td>$post_date </td>";
							echo "<td>$likes</td>";
							echo "<td>$post_slug</td>";

							?>

							<form method="post">
								<input type="hidden" name="post_id" value="<?php echo $post_id ?>">
								<?php   
								echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
								?>
							</form>

							<?php 
							echo "</tr>";

						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>Author</th>
							<th>Title</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Likes</th>
							<th>Slug</th>
							<th>Delete</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End Default Light Table -->

<?php 

if(isset($_POST['delete'])){
	$the_post_id = escape($_POST['post_id']);
	$query = "DELETE FROM blog_posts WHERE post_id = {$the_post_id} ";
	$delete_query = mysqli_query($connection, $query);
	header("Location: /admin/blog.php?source=view_all_posts");
}

?>