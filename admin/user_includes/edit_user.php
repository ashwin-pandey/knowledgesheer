<?php  // Get request user id and database data extraction

if(isset($_GET['edit_user'])){
	$the_user_id =  escape($_GET['edit_user']);
	// $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
	// $select_users_query = mysqli_query($connection,$query);  

	// while($row = mysqli_fetch_assoc($select_users_query)) {
	// 	$user_id        	= $row['user_id'];
	// 	$username       	= $row['username'];
	// 	$user_firstname 	= $row['user_firstname'];
	// 	$user_lastname  	= $row['user_lastname'];
	// 	$user_email     	= $row['user_email'];
	// 	$user_image     	= $row['user_image'];
	// 	$user_role      	= $row['user_role'];
	// 	$user_description   = $row['user_description'];
	// }

	$query = "SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role, user_description FROM users WHERE user_id = ? ";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 's', $the_user_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $user_description);
	confirmQuery($stmt);
	mysqli_stmt_fetch($stmt);


	if(isset($_POST['edit_user'])) {
		$user_firstname   	= escape($_POST['user_firstname']);
		$user_lastname    	= escape($_POST['user_lastname']);
		$user_role        	= escape($_POST['user_role']);
		$user_description   = escape($_POST['user_description']);

		$user_image = $_FILES['user_image']['name'];
		$user_image_temp = $_FILES['user_image']['tmp_name'];

		$date = date('m-d-Y');
		$microtime = round(microtime(true));
		$actual_name = pathinfo($user_image, PATHINFO_FILENAME);
		$ext = pathinfo($user_image, PATHINFO_EXTENSION);
		$image_path = "../assets/images/profile/";
		$prepend_name = 'Img_profile_' . $date . "_" . $microtime;
		$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
		$dest_file = $image_path . $full_img_name;

		move_uploaded_file($user_image_temp, $dest_file);

		// move_uploaded_file($user_image_temp, "../assets/images/profile/$user_image");

		if(empty($user_image)) {
			$query = "SELECT user_image FROM users WHERE user_id = $the_user_id ";
			$select_image = mysqli_query($connection,$query);
			while($row = mysqli_fetch_array($select_image)) {
				$full_img_name = $row['user_image'];
			}
		}

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

		$query = "UPDATE users SET ";
		$query .="user_firstname  = ?, ";
		$query .="user_lastname = ?, ";
		$query .="user_role   =  ?, ";
		$query .="username = ?, ";
		$query .="user_email = ?, ";
		$query .="user_image = ?, " ;
		$query .="user_description = ? " ;
		$query .= "WHERE user_id = ? ";

		$stmt = mysqli_prepare($connection, $query);
		confirmQuery($stmt);
		mysqli_stmt_bind_param($stmt, 'sssssssi', $user_firstname, $user_lastname, $user_role, $username, $user_email, $full_img_name, $user_description, $the_user_id);
		mysqli_stmt_execute($stmt);

		echo "
		<div class='alert alert-success alert-dismissible fade show mb-0' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>×</span>
			</button>
			<i class='fa fa-check mx-2'></i>
			<strong>Success!</strong> Your profile has been updated!
			<a href='users.php?source=view_all_users' class='float-right btn btn-primary'>View All Users</a> 
		</div>
		";
	}

} else {  // If the user id is not present in the URL we redirect to the home page
	header("Location: index.php");
	}

?>

<!-- Default Light Table -->
<div class="row pt-3">
	<div class="col-lg-4">
		<div class="card card-small mb-4 pt-3">
			<div class="card-body text-center">
				<div class="mb-3 mx-auto">
				<?php if (empty($user_image)) { ?>
					<img class="rounded-circle" src="../assets/images/profile/user.png" alt="<?php echo $user_firstname . " " . $user_lastname; ?>" width="110">
				<?php } else { ?>
					<img class="rounded-circle" src="../assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $user_firstname . " " . $user_lastname; ?>" width="110">
				<?php } ?>
				</div>
				<h4 class="mb-0"><?php echo $user_firstname . " " . $user_lastname; ?></h4>
				<span class="text-muted d-block mb-2"><?php echo $user_role; ?></span>
				<span class="text-muted d-block mb-2"><?php echo $user_email; ?></span>
				<span class="text-left d-block mb-2"><?php echo $user_description; ?></span>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Account Details</h6>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item p-3">
					<div class="row">
						<div class="col">
							<form method="post" action="" enctype="multipart/form-data">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="feFirstName">Username</label>
										<input type="text" class="form-control" name="username" id="feFirstName" value="<?php echo $username; ?>"> 
									</div>
									<div class="form-group col-md-6">
										<label for="feLastName">User Role</label>
										<select name="user_role" class="form-control">
											<?php 
											$query = 'SELECT * FROM user_roles';
											$select_categories = query($query);
											confirmQuery($select_categories);
											while ($row = mysqli_fetch_assoc($select_categories)) {
												$role_id = $row['role_id'];
												$role_title = $row['role_title'];

												if ($role_title == $user_role) {
													echo "<option selected value='$role_id'>{$role_title}</option>";
												} else {
													echo "<option value='$role_id'>{$role_title}</option>";
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="feFirstName">First Name</label>
										<input type="text" class="form-control" name="user_firstname"  placeholder="First Name" value="<?php echo($user_firstname) ?>"> 
									</div>
									<div class="form-group col-md-6">
										<label for="feLastName">Last Name</label>
										<input type="text" class="form-control" name="user_lastname" id="feLastName" value="<?php echo($user_lastname) ?>"> 
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="feEmailAddress">Email</label>
										<input type="email" class="form-control" name="user_email" value="<?php echo($user_email) ?>"> 
									</div>
									<div class="form-group col-md-6">
										<label for="fePassword">Profile Image</label>
										<input type="file" class="form-control" name="user_image" value="<?php echo($user_image) ?>"> 
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-12">
										<textarea name="user_description" class="form-control" cols="30" rows="5"><?php echo $user_description; ?></textarea>
									</div>
								</div>
								<button type="submit" name="edit_user" class="btn btn-accent">Update Account</button>
							</form>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- End Default Light Table -->