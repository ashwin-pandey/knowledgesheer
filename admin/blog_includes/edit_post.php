<?php

	if(isset($_GET['p_id'])){
		$the_post_id =  escape($_GET['p_id']);
	}


	$query = "SELECT * FROM blog_posts WHERE post_id = $the_post_id  ";
	$select_posts_by_id = query($query);

	while($row = mysqli_fetch_assoc($select_posts_by_id)) {
		$post_id            = $row['post_id'];
		$post_author        = $row['post_author'];
		$post_title         = $row['post_title'];
		$post_category_id   = $row['post_category_id'];
		$post_status        = $row['post_status'];
		$post_image         = $row['post_image'];
		$post_content       = $row['post_content'];
		$post_description	= $row['post_description'];
		$post_tags          = $row['post_tags'];
		$post_comment_count = $row['post_comment_count'];
		$post_date          = $row['post_date'];

	}

	// $stmt = mysqli_prepare($connection, "SELECT * FROM blog_posts WHERE post_id = ?");
	// mysqli_stmt_bind_param($stmt, 'i', $the_post_id);
	// mysqli_stmt_execute($stmt);

	// $result = $stmt->get_result();

	// while($row = $result->fetch_assoc()) {
	// 	$post_id            = $row['post_id'];
	// 	$post_author        = $row['post_author'];
	// 	$post_title         = $row['post_title'];
	// 	$post_category_id   = $row['post_category_id'];
	// 	$post_status        = $row['post_status'];
	// 	$post_image         = $row['post_image'];
	// 	$post_content       = $row['post_content'];
	// 	$post_description	= $row['post_description'];
	// 	$post_tags          = $row['post_tags'];
	// 	$post_comment_count = $row['post_comment_count'];
	// 	$post_date          = $row['post_date'];

	// }

	if(isset($_POST['update_post'])) {
		$post_user           =  $_POST['post_user'];
		$post_title          =  $_POST['post_title'];
		$post_category_id    =  $_POST['post_category'];
		$post_status         =  $_POST['post_status'];
		$post_image          =  $_FILES['post_image']['name'];
		$post_image_temp     =  $_FILES['post_image']['tmp_name'];
		$post_content        =  $_POST['post_content'];
		$post_description    =  $_POST['post_description'];
		$post_tags           =  $_POST['post_tags'];

		move_uploaded_file($post_image_temp, "../images/featured/$post_image"); 

		if(empty($post_image)) {
			// $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
			// $select_image = query($query);
			$stmt = mysqli_prepare($connection, "SELECT * FROM blog_posts WHERE post_id = ?");
			mysqli_stmt_bind_param($stmt, 'i', $the_post_id);
			mysqli_stmt_execute($stmt);
			$result = $stmt->get_result();
			while($row = $result->fetch_array()) {
				$post_image = $row['post_image'];
			}
		}
		$post_title = mysqli_real_escape_string($connection, $post_title);

		// $query  = "UPDATE blog_posts SET ";
		// $query .= "post_title  = '{$post_title}', ";
		// $query .= "post_category_id = '{$post_category_id}', ";
		// $query .= "post_date   =  now(), ";
		// $query .= "post_user = '{$post_user}', ";
		// $query .= "post_status = '{$post_status}', ";
		// $query .= "post_tags   = '{$post_tags}', ";
		// $query .= "post_content= '{$post_content}', ";
		// $query .= "post_image  = '{$post_image}' ";
		// $query .= "WHERE post_id = {$the_post_id} ";

		// $update_post = query($query);

		// confirmQuery($update_post);

		$query  = "UPDATE blog_posts SET ";
		$query .= "post_title  = ?, ";
		$query .= "post_category_id = ?, ";
		$query .= "post_date   =  now(), ";
		$query .= "post_user = ?, ";
		$query .= "post_status = ?, ";
		$query .= "post_tags   = ?, ";
		$query .= "post_content = ?, ";
		$query .= "post_description = ?, ";
		$query .= "post_image  = ? ";
		$query .= "WHERE post_id = ? ";
		
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, 'ssssssssi', $post_title, $post_category_id, $post_user, $post_status, $post_tags, $post_content, $post_description, $post_image, $the_post_id);
		mysqli_stmt_execute($stmt);

		// echo "<p class='bg-success'>Post Updated. <a href='../blog.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

		echo 
		"<div>
		<p style='display: inline-block;' class=''>Post Created. 
			<a class='btn btn-sm btn-info' href='../blog.php?p_id={$the_post_id}'>View Post </a> 
			or 
			<a class='btn btn-sm btn-secondary' href='blog.php?source=view_all_posts'>Edit More Posts</a>
		</p>
		<hr>";
	}

?>


<form action="" class="" method="POST" enctype="multipart/form-data">
	<div class="add-post-form">
		<!-- <div class="top-bar">
			<h5>Edit Post</h5>
			<div class="publish-button">
				<input class="btn btn-md btn-primary" type="submit" name="update_post" value="Update"></input>
			</div>
		</div>
		<hr> -->
		<div class="row">
			<div class="col-9">
				<!-- Title -->
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="post_title" class="form-control" value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>" required>
				</div>

				<!-- Content -->
				<div class="form-group">
					<label>Content</label>
					<textarea id="editor" class="form-control" name="post_content" required><?php echo $post_content; ?></textarea>
				</div>
			</div>
			<div class="col-3">
				<!-- Post Status -->
				<div class="form-group field-box">
					<label>Post Status</label>
					<select class="form-control" name="post_status" required>
						<option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
						<?php

						if($post_status == 'public' ) {
							echo "<option value='draft'>Draft</option>";
						} else {
							echo "<option value='public'>Public</option>";
						}

						?>
					</select>
					<hr>
					<input style="display: inline-block;" class="btn btn-sm btn-primary" type="submit" name="update_post" value="Update">
					<input style="display: inline-block;float: right;" type="submit" name="moveToTrash" class="btn btn-sm btn-danger" value="Move to Trash">
				</div>

				<!-- Category -->
				<div class="form-group field-box post-categories">
					<label>Category</label>
					<select class="form-control" name="post_category" required>
						<?php

						$query = "SELECT * FROM blog_categories ";
						$select_categories = query($query);

						confirmQuery($select_categories);

						while($row = mysqli_fetch_assoc($select_categories )) {
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];

							if($cat_id == $post_category_id) {
								echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
							} else {
								echo "<option value='{$cat_id}'>{$cat_title}</option>";
							}
						}

						?>
					</select>
				</div>

				<!-- Post Tags -->
				<div class="form-group field-box post-tags">
					<label>Tags</label>
					<input type="text" value="<?php echo $post_tags; ?>" name="post_tags" class="form-control" required>
					<p>*Write at-most 5 comma separated tags*</p>
				</div>

				<!-- Description -->
				<div class="form-group field-box">
					<label>Short Description</label>
					<textarea class="form-control" name="post_description" required><?php echo $post_description; ?></textarea>
				</div>

				<!-- Featured Image -->
				<div class="form-group field-box featured-image">
					<label>Featured Image</label>
					<img src="../images/featured/<?php echo $post_image; ?>">
					<input type="file" id="file-input" value="<?php echo $post_image; ?>" name="post_image" class="form-control" required>
					<div id="thumb-output"></div>
				</div>
			</div>
		</div>
	</div>
</form>