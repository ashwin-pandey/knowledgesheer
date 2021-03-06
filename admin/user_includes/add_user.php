<?php  

if(isset($_POST['add_user'])) {

	$user_firstname    = $_POST['user_firstname'];
	$user_lastname     = $_POST['user_lastname'];
	$user_role         = $_POST['user_role'];
	$username          = $_POST['username'];
	$user_email        = $_POST['user_email'];
	$user_password     = $_POST['user_password'];
	$user_description  = $_POST['user_description'];

	$query = 'SELECT randSalt FROM users';
	$select_randsalt = query($query);
	confirmQuery($select_randsalt);

	$row = mysqli_fetch_assoc($select_randsalt);
	$salt = $row['randSalt'];

	$user_password = crypt($user_password, $salt);

	$user_image 		= $_FILES['user_image']['name'];
	$user_image_temp	= $_FILES['user_image']['tmp_name'];

	$date = date('m-d-Y');
	$microtime = round(microtime(true));
	$actual_name = pathinfo($user_image, PATHINFO_FILENAME);
	$ext = pathinfo($user_image, PATHINFO_EXTENSION);
	$image_path = "../assets/images/profile/";
	$prepend_name = 'Img_profile_' . $date . "_" . $microtime;
	$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
	$dest_file = $image_path . $full_img_name;

	move_uploaded_file($user_image_temp, $dest_file);

	// move_uploaded_file($user_image_temp, "../assets/images/profile/$user_image" );

	$query = 'SELECT * FROM user_roles';
	$select_roles = query($query);

	confirmQuery($select_roles);

	while ($row = mysqli_fetch_assoc($select_roles)) {
		$role_id = $row['role_id'];
		$role_title = $row['role_title'];
		if ($role_id == $user_role) {
			$user_role = $role_title;
		}
	}

	$stmt = mysqli_prepare($connection, "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password, user_image, user_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, 'ssssssss', $user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password, $full_img_name, $user_description);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);

	redirect($baseURL . "/admin/users.php?source=view_all_users");

}

?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Users</span>
		<h3 class="page-title">Add New User</h3>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
	<div class="col-12">
		<div class="card p-3">
			<form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
				<div class="add-new-user">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" placeholder="zap" autocomplete="false" required>
							</div>
							<div class="form-group">
								<label>First Name</label>
								<input type="text" name="user_firstname" class="form-control" placeholder="Jane" required>
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input type="text" name="user_lastname" class="form-control" placeholder="Doe" required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="user_email" class="form-control" autocomplete="false" placeholder="email@gmail.com" required>
							</div>
							<div class="form-group">
								<label>User Role</label>
								<select class="form-control" name="user_role" required>
									<option value="select">select</option>
									<?php 

									$query = 'SELECT * FROM user_roles';
									$select_categories = query($query);

									confirmQuery($select_categories);

									while ($row = mysqli_fetch_assoc($select_categories)) {
										$role_id = $row['role_id'];
										$role_title = $row['role_title'];
										echo "<option value='$role_id'>{$role_title}</option>";
									}

									?>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="user_password" class="form-control" autocomplete="false" placeholder="********" required>
							</div>
							<div class="form-group post-tags">
								<label>Profile Image</label>
								<p>*Preferable dimensions are 80x80*</p>
								<input type="file" id="file-input" name="user_image" class="form-control">
								<div id="thumb-output"></div>
							</div>
							<div class="publish-button">
								<input class="btn btn-md btn-primary" type="submit" name="add_user" value="Add User"></input>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<textarea name="user_description" class="form-control" cols="30" rows="10" placeholder="Something about yourself..."></textarea>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>