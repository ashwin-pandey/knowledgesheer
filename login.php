<?php 

$title = 'Login'; 
$page = 'login'; 
$header_title = 'Login';
include 'partials/header.php'; 

?>

<?php

checkIfUserIsLoggedInAndRedirect('/admin/');

// if(ifItIsMethod('POST')){

// 	if(isset($_POST['username']) && isset($_POST['password'])){
// 		login_user($_POST['username'], $_POST['password']);
// 	}else {
// 		redirect('index.php');
// 	}
// }

if (isset($_POST['login'])) {
	login_user($_POST['username'], $_POST['password']);
}

?>
<div class="row justify-content-md-center">
	<div class="col-lg-4 col-md-6 col-sm-8 col-12">
		<div class="login-form">
			<h4>LOGIN</h4>
			<form method="POST">
				<div class="form-group">
					<input type="text" name="username" placeholder="username" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="********" class="form-control" required>
				</div>
				<input type="submit" name="login" value="Log In" class="form-control btn btn-sm btn-primary">

				<hr>
				<div class="text-center">
					<a href="#">Forgot Password?</a>
				</div>
			</form>
			<!-- <hr>
			<p>New here: <a href="registration.php">Create Account</a></p> -->
		</div>
	</div>
</div>

<?php include 'partials/footer.php'; ?>