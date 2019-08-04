<?php  

if(isset($_POST['add_user'])) {

	$user_firstname    = escape($_POST['user_firstname']);
	$user_lastname     = escape($_POST['user_lastname']);
	$user_role         = escape($_POST['user_role']);
	$username          = escape($_POST['username']);
	$user_email        = escape($_POST['user_email']);
	$user_password     = escape($_POST['user_password']);

	$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

	$user_image 		= escape($_FILES['user_image']['name']);
	$user_image_temp	= escape($_FILES['user_image']['tmp_name']);

	move_uploaded_file($user_image_temp, "../assets/images/profile/$user_image" );

	$query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password, user_image) ";
	$query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}', '{$user_password}', '{$user_image}') "; 
	$create_user_query = query($query);
	confirmQuery($create_user_query); 

	redirect("users.php?source=view_all_users");

}

?>

<form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
	<h5>Add New User</h5>
	<div class="publish-button">
		<input class="btn btn-md btn-primary" type="submit" name="add_user" value="Add User"></input>
	</div>
	<hr>
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
						<option value="subscriber">Subscriber</option>
						<option value="admin">Admin</option>
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
					<input type="file" id="file-input" name="user_image" class="form-control" required>
					<div id="thumb-output"></div>
				</div>
			</div>
		</div>
	</div>
</form>