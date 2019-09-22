<?php 

$title = 'Profile'; 
$page = 'profile'; 
$header_title = 'Profile';
include 'partials/header.php'; 

$query = "SELECT user_id, username, user_firstname, user_lastname, user_email, user_image, user_role, user_description FROM users WHERE user_id = ? ";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 's', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_email, $user_image, $user_role, $user_description);
confirmQuery($stmt);
mysqli_stmt_fetch($stmt);


if(isset($_POST['edit_user'])) {
    $user_firstname   	= $_POST['user_firstname'];
    $user_lastname    	= $_POST['user_lastname'];
    $user_description   = $_POST['user_description'];

    $user_image = $_FILES['user_image']['name'];
	$user_image_temp = $_FILES['user_image']['tmp_name'];
	
	$date = date('m-d-Y');
	$microtime = round(microtime(true));
	$actual_name = pathinfo($user_image, PATHINFO_FILENAME);
	$ext = pathinfo($user_image, PATHINFO_EXTENSION);
	$image_path = "./assets/images/profile/";
	$prepend_name = 'Img_profile_' . $date . "_" . $microtime;
	$full_img_name = $prepend_name . '_' . $actual_name . '.' . $ext;
	$dest_file = $image_path . $full_img_name;

	move_uploaded_file($user_image_temp, $dest_file);

    // move_uploaded_file($user_image_temp, "./assets/images/profile/$user_image");

    if(empty($user_image)) {
        $query = "SELECT user_image FROM users WHERE user_id = " . $user_id . "";
        $select_image = mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($select_image)) {
            $full_img_name = $row['user_image'];
        }
    }

    $query = "UPDATE users SET ";
    $query .="user_firstname  = ?, ";
    $query .="user_lastname = ?, ";
    $query .="user_image = ?, ";
    $query .="user_description = ? " ;
    $query .= "WHERE user_id = ? ";

    $stmt = mysqli_prepare($connection, $query);
    confirmQuery($stmt);
    mysqli_stmt_bind_param($stmt, 'sssss', $user_firstname, $user_lastname, $full_img_name, $user_description, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    redirect("profile.php");


}

?>

<div class="row pt-3">
    <div class="col-lg-4">
		<div class="card card-small mb-4 pt-3">
			<div class="card-body text-center">
				<div class="mb-3 mx-auto">
				<?php if (empty($user_image)) { ?>
					<img class="rounded-circle" src="./assets/images/profile/user.png" alt="<?php echo $user_firstname . " " . $user_lastname; ?>" width="110">
				<?php } else { ?>
					<img class="rounded-circle" src="./assets/images/profile/<?php echo($user_image); ?>" alt="<?php echo $user_firstname . " " . $user_lastname; ?>" width="110">
				<?php } ?>
				</div>
				<h4 class="mb-0"><?php echo $user_firstname . " " . $user_lastname; ?></h4>
				<span class="text-muted d-block mb-2"><?php echo $user_role; ?></span>
				<span class="text-muted d-block mb-2"><?php echo $user_email; ?></span>
				<span class="text-left d-block mb-2"><?php echo stripslashes($user_description); ?></span>
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
							<form method="post" enctype="multipart/form-data">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="feFirstName">Username</label>
										<input type="text" class="form-control" name="username" id="feFirstName" value="<?php echo $username; ?>" disabled> 
									</div>
									<div class="form-group col-md-6">
										<label for="fe	LastName">User Role</label>
										<?php 
                                        $query = 'SELECT * FROM user_roles';
                                        $select_categories = query($query);
                                        confirmQuery($select_categories);
                                        while ($row = mysqli_fetch_assoc($select_categories)) {
                                            $role_id = $row['role_id'];
                                            $role_title = $row['role_title'];

                                            if ($role_title == $user_role) {
                                                echo "<input type='text' class='form-control' value='$role_title' disabled>";
                                            }
                                        }
                                        ?>
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
										<input type="email" class="form-control" name="user_email" value="<?php echo($user_email) ?>" disabled> 
									</div>
									<div class="form-group col-md-6">
										<label for="fePassword">Profile Image</label>
										<input type="file" class="form-control" name="user_image" value="<?php echo($user_image) ?>"> 
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-12">
										<textarea name="user_description" class="form-control" cols="30" rows="5"><?php echo stripslashes($user_description); ?></textarea>
									</div>
								</div>
								<button type="submit" name="edit_user" class="btn btn-accent btn-primary">Update</button>
							</form>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php include 'partials/footer.php'; ?>