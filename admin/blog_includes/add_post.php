 <?php

if(isset($_POST['public'])) {

	$post_title			= $_POST['post_title'];
	$post_content		= $_POST['post_content'];

	$post_content		= str_ireplace("\r\n", '', $post_content);
	$post_description	= $_POST['post_description'];

	$author_name		= $_SESSION['username'];
	$post_author		= $author_name;

	$post_status		= 'public';
	$post_category_id	= $_POST['post_category'];
	$post_sub_category_id	= $_POST['post_sub_category'];
	$post_tags			= $_POST['post_tags'];

	$post_image 		= escape($_FILES['post_image']['name']);
	$post_image_temp	= escape($_FILES['post_image']['tmp_name']);

	move_uploaded_file($post_image_temp, "../assets/images/blog-images/$post_image" );

	$post_date			= escape(date('d-m-y'));

	$stmt = mysqli_prepare($connection, "INSERT INTO blog_posts(post_category_id, post_sub_cat_id, post_title, post_author, post_date, post_content, post_tags, post_status, post_image, post_description) VALUES (?, ?, ?, ?, now(), ?, ?, ?, ?, ?)");

	mysqli_stmt_bind_param($stmt, 'sssssssss', $post_category_id, $post_sub_category_id, $post_title, $post_author, $post_content, $post_tags, $post_status, $post_image, $post_description);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);

	$the_post_id = mysqli_insert_id($connection);

	// redirect('/knowledgesheer/admin/blog.php?source=edit_post&p_id={$the_post_id}');

	echo 
	"<div>
	<p style='display: inline-block;' class=''>Post Created. 
		<a class='btn btn-sm btn-info' href='../blog_post.php?p_id={$the_post_id}'>View Post </a> 
		or 
		<a class='btn btn-sm btn-secondary' href='blog.php?source=view_all_posts'>Edit More Posts</a>
	</p>
	</div>";

}
  
?>

<style>
.ck-editor__editable {
	min-height: 412px;
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
						<input name="post_title" class="form-control form-control-lg mb-3" type="text" placeholder="Your Post Title">
						<textarea id="editor" class="form-control" name="post_content" placeholder="Keep calm and write something..."></textarea>
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

							<select class="form-control" name="post_category" required>
								<option>Select category</option>
								<?php 

								$query = 'SELECT * FROM categories';
								$select_categories = query($query);
								
								confirmQuery($select_categories);

								while ($row = mysqli_fetch_assoc($select_categories)) {
									$cat_id = $row['cat_id'];
									$cat_title = $row['cat_title'];
									echo "<option value='$cat_id'>{$cat_title}</option>";
								}

								?>
							</select>
						</li>
					</ul>
				</div>
			</div>
			<!-- / Post Overview -->
			<div class="card card-small mb-3">
				<div class="card-header border-bottom">
					<div class="m-0">Sub Categories</div>
				</div>
				<div class="card-body p-0">
					<ul class="list-group list-group-flush">
						<li class="list-group-item px-3 pb-2">
							<select class="form-control" name="post_sub_category" required>
								<option>Select category</option>
								<?php 

								$query = 'SELECT * FROM sub_categories';
								$select_categories = query($query);
								
								confirmQuery($select_categories);

								while ($row = mysqli_fetch_assoc($select_categories)) {
									$sub_cat_id = $row['sub_cat_id'];
									$sub_cat_title = $row['sub_cat_title'];
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