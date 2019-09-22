 <?php

if(isset($_POST['public'])) {

	$post_title			= $_POST['post_title'];
	$post_content		= $_POST['post_content'];

	$post_content		= str_ireplace("\r\n", '', $post_content);
	$post_description	= $_POST['post_description'];

	$post_slug			= trim($_POST['post_slug']);

	$author_name		= $_SESSION['username'];
	$post_author		= $author_name;

	$post_status		= 'public';
	$post_category_id	= $_POST['post_category'];
	$post_sub_category_id	= $_POST['post_sub_category'];
	$post_tags			= $_POST['post_tags'];

	$post_image 		= escape($_FILES['post_image']['name']);
	$post_image_temp	= escape($_FILES['post_image']['tmp_name']);

	$date = date('m-d-Y');
	$microtime = round(microtime(true));
	$actual_name = pathinfo($post_image, PATHINFO_FILENAME);
	$ext = pathinfo($post_image, PATHINFO_EXTENSION);
	$image_path = "../assets/images/blog-images/";
	$prepend_name = 'Img_' . $date . "_" . $microtime;
	$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
	$dest_file = $image_path . $full_img_name;

	move_uploaded_file($post_image_temp, $dest_file);

	$post_date			= escape(date('d-m-y'));

	$stmt = mysqli_prepare($connection, "INSERT INTO blog_posts(post_category_id, post_sub_cat_id, post_title, post_author, post_date, post_content, post_tags, post_status, post_image, post_description, post_slug) VALUES (?, ?, ?, ?, now(), ?, ?, ?, ?, ?, ?)");

	mysqli_stmt_bind_param($stmt, 'ssssssssss', $post_category_id, $post_sub_category_id, $post_title, $post_author, $post_content, $post_tags, $post_status, $full_img_name, $post_description, $post_slug);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);

	$the_post_id = mysqli_insert_id($connection);

	// redirect('/blog.php?source=edit_post&p_id={$the_post_id}');
	echo "<meta http-equiv='refresh' content='0'>";
}
  
?>

<style>
.ck-editor__editable {
	min-height: 412px;
}
.hide {
	display: none;
}
</style>

<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Blog Posts</span>
		<h3 class="page-title">Add New Post</h3>
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
							<input name="post_title" oninput="convertToSlug(this.value, 'blog_post');" class="form-control form-control-lg" type="text" placeholder="Your Post Title">
						</div>
						<div class="form-group">
							<input type="text" id="slug" name="post_slug" class="form-control" placeholder="your-slug-url">
						</div>
						<div class="form-group">
							<textarea id="editor" class="form-control" name="post_content" placeholder="Keep calm and write something..."></textarea>
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
							<button type="submit" name="draft" class="btn btn-sm btn-outline-accent">
							<i class="material-icons">save</i> Save Draft</button>
							<button type="submit" name="public" class="btn btn-sm btn-accent ml-auto">
							<i class="material-icons">file_copy</i> Publish</button>
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

							<select class="form-control" id="post_category" name="post_category" required>
								<option>Select category</option>
								<?php 
								$query = 'SELECT cat_id, cat_title FROM categories';
								$cat_stmt = mysqli_prepare($connection, $query);
								mysqli_stmt_execute($cat_stmt);
								mysqli_stmt_store_result($cat_stmt);
								mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_title);
								// $select_categories = query($query);
								confirmQuery($cat_stmt);

								while (mysqli_stmt_fetch($cat_stmt)) {
									echo "<option value='$cat_id'>{$cat_title}</option>";
								}
								?>
							</select>
						</li>
					</ul>
				</div>
			</div>
			<!-- / Post Overview -->
			<div class="card card-small sub-category mb-3">
				<div class="card-header border-bottom">
					<div class="m-0">Sub Categories</div>
				</div>
				<div class="card-body p-0">
					<ul class="list-group list-group-flush">
						<li class="list-group-item px-3 pb-2">
							<select class="form-control" name="post_sub_category" required>
								<option>Select sub category</option>
								<?php 
								$query = "SELECT sub_cat_id, sub_cat_title FROM sub_categories";
								$sub_cat_stmt = mysqli_prepare($connection, $query);
								mysqli_stmt_execute($sub_cat_stmt);
								mysqli_stmt_store_result($sub_cat_stmt);
								mysqli_stmt_bind_result($sub_cat_stmt, $sub_cat_id, $sub_cat_title);
								while(mysqli_stmt_fetch($sub_cat_stmt)) {
									echo "<option value='$sub_cat_id'>{$sub_cat_title}</option>";
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
					<input type="text" name="post_tags" class="form-control" placeholder="One, Two, Three..." required>
				</div>
			</div>
			<!-- / Post tags -->
			<!-- Post Description -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Short Description</h6>
				</div>
				<div class='card-body p-0'>
					<textarea name="post_description" class="form-control" id="" cols="30" rows="10" placeholder="Describe the post in short..."></textarea>
				</div>
			</div>
			<!-- / Post Description -->
			<!-- Post Image -->
			<div class='card card-small mb-3'>
				<div class="card-header border-bottom">
					<h6 class="m-0">Short Description</h6>
				</div>
				<div class='card-body p-0'>
					<input  type="file" class="form-control" id="file-input" name="post_image" required>
					<div id="thumb-output" style="width: 235px;"></div>
				</div>
			</div>
			<!-- / Post Image -->
		</div>
	</div>
</form>