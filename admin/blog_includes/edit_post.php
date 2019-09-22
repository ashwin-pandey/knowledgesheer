<?php

	if(isset($_GET['p_id'])){
		$the_post_id =  escape($_GET['p_id']);
	}
	
	$query = "SELECT * FROM blog_posts WHERE post_id = $the_post_id  ";
	$select_posts_by_id = query($query);

	while($row = mysqli_fetch_assoc($select_posts_by_id)) {
		$post_id            	= $row['post_id'];
		$post_author        	= $row['post_author'];
		$post_title         	= $row['post_title'];
		$post_category_id   	= $row['post_category_id'];
		$post_sub_category_id   = $row['post_sub_cat_id'];
		$post_status        	= $row['post_status'];
		$post_image         	= $row['post_image'];
		$post_content       	= $row['post_content'];
		$post_description		= $row['post_description'];
		$post_slug				= $row['post_slug'];
		$post_tags          	= $row['post_tags'];
		$post_comment_count 	= $row['post_comment_count'];
		$post_date          	= $row['post_date'];

	}

	if(isset($_POST['update_post'])) {
		$post_title          	=  $_POST['post_title'];
		$post_category_id    	=  $_POST['post_category'];
		$post_sub_cat_id	=  $_POST['post_sub_category'];
		$post_content        	=  $_POST['post_content'];
		$post_content        	=  str_ireplace("\r\n", '', $post_content);
		$post_description    	=  $_POST['post_description'];
		$post_tags           	=  $_POST['post_tags'];
		$post_slug				=  trim($_POST['post_slug']);

		$post_image          	=  escape($_FILES['post_image']['name']);
		$post_image_temp     	=  escape($_FILES['post_image']['tmp_name']);

		$date = date('m-d-Y');
		$microtime = round(microtime(true));
		$actual_name = pathinfo($post_image, PATHINFO_FILENAME);
		$ext = pathinfo($post_image, PATHINFO_EXTENSION);
		$image_path = "../assets/images/blog-images/";
		$prepend_name = 'Img_' . $date . "_" . $microtime;
		$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
		$dest_file = $image_path . $full_img_name;

		move_uploaded_file($post_image_temp, $dest_file); 
		
		if(empty($post_image)) {
			$query = "SELECT * FROM blog_posts WHERE post_id = " . $the_post_id;
			$select_image = query($query);
			confirmQuery($select_image);
			while($row = mysqli_fetch_array($select_image)) {
				$full_img_name = $row['post_image'];
			}
		}

		$query  = "UPDATE blog_posts SET ";
		$query .= "post_title  = ?, ";
		$query .= "post_category_id = ?, ";
		$query .= "post_sub_cat_id = ?, ";
		$query .= "post_tags = ?, ";
		$query .= "post_image = ?, ";
		$query .= "post_content = ?, ";
		$query .= "post_slug = ?, ";
		$query .= "post_description = ? ";
		$query .= "WHERE post_id = ? ";
		
		$stmt = mysqli_prepare($connection, $query);
		if (!$stmt) {
			die("Query Failed! - " . mysqli_error($connection));
		}
		mysqli_stmt_bind_param($stmt, 'ssssssssi', $post_title, $post_category_id, $post_sub_category_id, $post_tags, $full_img_name, $post_content, $post_slug, $post_description, $the_post_id);
		mysqli_stmt_execute($stmt);

		echo "<meta http-equiv='refresh' content='0'>";
	}

?>
<style>
.ck-editor__editable{min-height: 412px;}
</style>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Blog Posts</span>
		<h3 class="page-title">Edit Post</h3>
	</div>
</div>
<!-- End Page Header -->

<form method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-9 col-md-12">
			<!-- Add New Post Form -->
			<div class="card card-small mb-3">
				<div class="card-body">
					<div class="add-new-post">
						<div class="form-group">
							<input type="text" oninput="convertToSlug(this.value, 'blog_post');" name="post_title" class="form-control form-control-lg mb-3" value="<?php echo stripslashes($post_title); ?>" required>
						</div>
						<div class="form-group">
							<input type="text" id="slug" name="post_slug" class="form-control" value="<?php echo $post_slug; ?>">
						</div>
						<div class="form-group">
							<textarea id="editor" class="form-control form-control-lg mb-3" name="post_content" required><?php echo stripslashes($post_content); ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- / Add New Post Form -->
		</div>
		<div class="col-lg-3 col-md-12">
			<!-- Post Overview -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Actions</h6>
				</div>
				<div class='card-body p-0'>
					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex px-3">
							<button type="submit" name="update_post" class="btn btn-sm btn-accent ml-auto">
							<i class="material-icons">file_copy</i> Update</button>
						</li>
					</ul>
				</div>
			</div>
			<!-- / Post Overview -->
			<!-- Post Overview -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Categories</h6>
				</div>
				<div class='card-body p-0'>
					<ul class="list-group list-group-flush">
						<li class="list-group-item px-3 pb-2">

							<select class="form-control" name="post_category" required>
							<?php

							$query = "SELECT * FROM categories ";
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
							
						</li>
					</ul>
				</div>
			</div>
			<!-- / Post Overview -->

			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Sub Categories</h6>
				</div>
				<div class='card-body p-0'>
					<ul class="list-group list-group-flush">
						<li class="list-group-item px-3 pb-2">

							<select class="form-control" name="post_sub_category" required>
							<?php

							$query = "SELECT * FROM sub_categories ";
							$select_categories = query($query);

							confirmQuery($select_categories);

							while($row = mysqli_fetch_assoc($select_categories )) {
								$sub_cat_id = $row['sub_cat_id'];
								$sub_cat_title = $row['sub_cat_title'];

								if($sub_cat_id == $post_sub_cat_id) {
									echo "<option selected value='{$sub_cat_id}'>{$sub_cat_title}</option>";
								} else {
									echo "<option value='{$sub_cat_id}'>{$sub_cat_title}</option>";
								}
							}

							?>
							</select>
							
						</li>
					</ul>
				</div>
			</div>
			<!-- Post Tags -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Post Tags</h6>
				</div>
				<div class='card-body p-0'>
					<input type="text" value="<?php echo stripslashes($post_tags); ?>" name="post_tags" class="form-control" required>
				</div>
			</div>
			<!-- / Post tags -->
			<!-- Post Description -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Short Description</h6>
				</div>
				<div class='card-body p-0'>
					<textarea class="form-control" name="post_description" cols="30" rows="10" required><?php echo stripslashes($post_description); ?></textarea>
				</div>
			</div>
			<!-- / Post Description -->
			<!-- Post Image -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Short Description</h6>
				</div>
				<div class='card-body p-0 text-center'>
					<label>Previous Image</label>
					<img width="200" src="../assets/images/blog-images/<?php echo $post_image; ?>" alt="">
					<label>Set a new one!</label>
					<input  type="file" id="file-input" name="post_image">
					<div id="thumb-output" style="width: 235px;"></div>
				</div>
			</div>
			<!-- / Post Image -->
		</div>
	</div>
</form>
