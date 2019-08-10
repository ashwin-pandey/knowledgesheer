<?php

if(isset($_POST['create_post'])) {

	$post_title			= escape($_POST['post_title']);
	$post_content		= escape($_POST['post_content']);
	$post_description	= escape($_POST['post_description']);

	$author_name		= $_SESSION['username'];
	$post_author		= $author_name;

	$post_status		= escape($_POST['post_status']);
	$post_category_id	= escape($_POST['post_category']);
	$post_tags			= escape($_POST['post_tags']);

	// $post_image 		= escape($_FILES['post_image']['name']);
	// $post_image_temp	= escape($_FILES['post_image']['tmp_name']);

	// move_uploaded_file($post_image_temp, "../assets/images/blog-images/$post_image" );

	$post_date			= escape(date('d-m-y'));

	$stmt = mysqli_prepare($connection, "INSERT INTO blog_posts(post_category_id, post_title, post_author, post_date,post_content,post_tags,post_status, post_description) VALUES (?, ?, ?, now(), ?, ?, ?, ?)");

	mysqli_stmt_bind_param($stmt, 'ssssssss', $post_category_id, $post_title, $post_author, $post_image, $post_content, $post_tags, $post_status, $post_description);
	mysqli_stmt_execute($stmt);

// =========================
// OLD METHOD
// =========================
	// $query = "INSERT INTO blog_posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";

	// $query .= "VALUES({$post_category_id},{$post_title},{$post_author},now(),{$post_image},{$post_content},{$post_tags}, {$post_status}) "; 

	// mysqli_stmt_close($stmt);

	// $create_post_query = query($query);  

	// confirmQuery($create_post_query);
// =========================

	$the_post_id = mysqli_insert_id($connection);

	redirect('/knowledgesheer/admin/blog.php?source=edit_post&p_id={$the_post_id}');

	echo 
	"<div>
	<p style='display: inline-block;' class=''>Post Created. 
		<a class='btn btn-sm btn-info' href='../blog.php?p_id={$the_post_id}'>View Post </a> 
		or 
		<a class='btn btn-sm btn-secondary' href='blog.php?source=view_all_posts'>Edit More Posts</a>
	</p>
	<a style='display: inline-block; float: right;' href='blog.php?source=add_post' class='btn btn-sm btn-primary'>Add New</a>
	</div>
	<hr>";

}
  
?>

<style>
.ck-editor__editable {
	min-height: 412px;
}
</style>



<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Blog Posts</span>
		<h3 class="page-title">Add New Post</h3>
	</div>
</div>
<!-- End Page Header -->
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
					<li class="list-group-item p-3">
						<span class="d-flex mb-2">
							<i class="material-icons mr-1">flag</i>
							<strong class="mr-1">Status:</strong> Draft
							<a class="ml-auto" href="#">Edit</a>
						</span>
						<span class="d-flex mb-2">
							<i class="material-icons mr-1">visibility</i>
							<strong class="mr-1">Visibility:</strong>
							<strong class="text-success">Public</strong>
							<a class="ml-auto" href="#">Edit</a>
						</span>
						<span class="d-flex mb-2">
							<i class="material-icons mr-1">calendar_today</i>
							<strong class="mr-1">Schedule:</strong> Now
							<a class="ml-auto" href="#">Edit</a>
						</span>
						<span class="d-flex">
							<i class="material-icons mr-1">score</i>
							<strong class="mr-1">Readability:</strong>
							<strong class="text-warning">Ok</strong>
						</span>
					</li>
					<li class="list-group-item d-flex px-3">
						<button class="btn btn-sm btn-outline-accent">
						<i class="material-icons">save</i> Save Draft</button>
						<button class="btn btn-sm btn-accent ml-auto">
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
						<div class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" id="category1" checked>
							<label class="custom-control-label" for="category1">Uncategorized</label>
						</div>
						<div class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" id="category2" checked>
							<label class="custom-control-label" for="category2">Design</label>
						</div>
						<div class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" id="category3">
							<label class="custom-control-label" for="category3">Development</label>
						</div>
						<div class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" id="category4">
							<label class="custom-control-label" for="category4">Writing</label>
						</div>
						<div class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" id="category5">
							<label class="custom-control-label" for="category5">Books</label>
						</div>
					</li>
					<li class="list-group-item d-flex px-3">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="New category" aria-label="Add new category" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-white px-2" type="button">
								<i class="material-icons">add</i>
								</button>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- / Post Overview -->
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
	</div>
</div>









<form action="" class="" method="POST" enctype="multipart/form-data">
	<div class="add-post-form">
		<!-- <div class="top-bar">
			<h5>Add Post</h5>
			<div class="publish-button">
				<input class="btn btn-md btn-primary" type="submit" name="create_post" value="Publish"></input>
			</div>
		</div>
		<hr> -->
		<div class="row">
			<div class="col-9">
				<!-- Title -->
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="post_title" class="form-control" placeholder="Title..." required>
				</div>

				<!-- Content -->
				<div class="form-group">
					<label>Content</label>
					<!-- <textarea id="editor" class="form-control" name="post_content" placeholder="Keep calm and write something..."></textarea> -->
				</div>
			</div>

			<div class="col-3">
				<!-- Post Status -->
				<div class="form-group field-box">
					<label>Post Status</label>
					<select class="form-control" name="post_status" required>
						<option value="draft">Draft</option>
						<option value="public">Public</option>
					</select>
					<hr>
					<input style="display: inline-block;" class="btn btn-sm btn-primary" type="submit" name="create_post" value="Publish">
					<input style="display: inline-block;float: right;" type="submit" name="moveToTrash" class="btn btn-sm btn-danger" value="Move to Trash">
				</div>

				<!-- Category -->
				<div class="form-group field-box post-categories">
					<label>Category</label>
					<select class="form-control" name="post_category" required>
						<option>Select category</option>
						<?php 

						$query = 'SELECT * FROM blog_categories';
						$select_categories = query($query);
						
						confirmQuery($select_categories);

						while ($row = mysqli_fetch_assoc($select_categories)) {
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];
							echo "<option value='$cat_id'>{$cat_title}</option>";
						}

						?>
					</select>
				</div>

				<!-- Post Tags -->
				<div class="form-group field-box post-tags">
					<label>Tags</label>
					<input type="text" name="post_tags" class="form-control" required>
					<p>*Write at-most 5 comma separated tags*</p>
				</div>

				<!-- Description -->
				<div class="form-group field-box">
					<label>Short Description</label>
					<textarea class="form-control" name="post_description" placeholder="Post description..."></textarea>
				</div>

				<!-- Featured Image -->
				<div class="form-group field-box featured-image">
					<label>Featured Image</label>
					<input type="file" id="file-input" name="post_image" class="form-control" required>
					<div id="thumb-output"></div>
				</div>
			</div>
		</div>
	</div>
</form>