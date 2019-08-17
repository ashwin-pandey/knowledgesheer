<?php


include("delete_modal.php");

if(isset($_POST['checkBoxArray'])) {
	foreach($_POST['checkBoxArray'] as $postValueId ){

		$bulk_options = $_POST['bulk_options'];

		switch($bulk_options) {
			// Public
			case 'public':
			$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
			$update_to_published_status = mysqli_query($connection,$query);       
			confirmQuery($update_to_published_status);
			break;

			// Draft
			case 'draft':
			$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
			$update_to_draft_status = mysqli_query($connection,$query);
			confirmQuery($update_to_draft_status);
			break;

			// Delete
			case 'delete':
			$query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
			$update_to_delete_status = mysqli_query($connection,$query);
			confirmQuery($update_to_delete_status);
			break;

			// Clone
			// case 'clone':
			// $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
			// $select_post_query = mysqli_query($connection, $query);

			// while ($row = mysqli_fetch_array($select_post_query)) {
			// 	$post_title         = $row['post_title'];
			// 	$post_category_id   = $row['post_category_id'];
			// 	$post_date          = $row['post_date']; 
			// 	$post_author        = $row['post_author'];
			// 	$post_status        = $row['post_status'];
			// 	$post_image         = $row['post_image'] ; 
			// 	$post_tags          = $row['post_tags']; 
			// 	$post_content       = $row['post_content'];

			// }

			// $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";

			// $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

			// $copy_query = mysqli_query($connection, $query);   

			// if(!$copy_query ) {
			// 	die("QUERY FAILED" . mysqli_error($connection));
			// }   
			// break;
		}
	}
}

?>


<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Blog Posts</span>
		<h3 class="page-title">View All Posts</h3>
	</div>
</div>
<!-- End Page Header -->

<!-- Default Light Table -->
<div class="row">
	<div class="col">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<!-- <h6 class="m-0">All Blog Posts</h6> -->
				<div class="row">
					<div id="bulkOptionContainer" class="col-2">
						<select class="form-control" name="bulk_options" id="">
							<option value="">Select Options</option>
							<option value="public">Publish</option>
							<option value="draft">Draft</option>
							<option value="delete">Delete</option>
							<!-- <option value="clone">Clone</option> -->
						</select>
					</div> 
					<div class="col-10">
						<input type="submit" name="submit" class="btn btn-success" value="Apply">
						<a class="btn btn-primary float-right" href="posts.php?source=add_post">Add New</a>
					</div>
				</div>
			</div>
			<div class="card-body pb-3 text-left">
				<table class="table table-striped table-bordered" style="width: 100%;" id="view_all_posts">
					<thead class="bg-light">
						<tr>
							<th scope="col" class="">
								<input id="selectAllBoxes" type="checkbox">
							</th>
							<th scope="col" class="">Author</th>
							<th scope="col" class="">Title</th>
							<th scope="col" class="">Category</th>
							<th scope="col" class="">Sub Category</th>
							<th scope="col" class="">Tags</th>
							<th scope="col" class="">Date</th>
							<th scope="col" class="">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						$query = "SELECT * FROM blog_posts ORDER BY post_id DESC ";
						$select_posts = mysqli_query($connection,$query);  

						while($row = mysqli_fetch_assoc($select_posts )) {
							$post_id            = $row['post_id'];
							$post_author        = $row['post_author'];
							$post_title         = $row['post_title'];
							$post_category_id   = $row['post_category_id'];
							$post_sub_cat_id   	= $row['post_sub_cat_id'];
							$post_status        = $row['post_status'];
							$post_tags          = $row['post_tags'];
							$post_date          = $row['post_date'];

							echo "<tr>";

							?>

							<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

							<?php 

							echo "<td>$post_author</td>";
							echo "<td>
							$post_title -- $post_status<br>
							<a href='../blog_post.php?p_id={$post_id}' target='_blank'>View</a>&nbsp;
							<a href='blog.php?source=edit_post&p_id={$post_id}'>Edit</a>
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
							<th scope="col" class="border-0">
								<input id="selectAllBoxes" type="checkbox">
							</th>
							<th scope="col" class="">Author</th>
							<th scope="col" class="">Title</th>
							<th scope="col" class="">Category</th>
							<th scope="col" class="">Sub Category</th>
							<th scope="col" class="">Tags</th>
							<th scope="col" class="">Date</th>
							<th scope="col" class="">Delete</th>
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
	header("Location: /knowledgesheer/admin/blog.php?source=view_all_posts");
}

?> 

<script>
	$(document).ready(function(){
		$(".delete_link").on('click', function(){
			var id = $(this).attr("rel");
			var delete_url = "posts.php?delete="+ id +" ";
			$(".modal_delete_link").attr("href", delete_url);
			$("#myModal").modal('show');
		});
	});

	<?php if(isset($_SESSION['message'])){
		unset($_SESSION['message']);
	}
	?>
</script>