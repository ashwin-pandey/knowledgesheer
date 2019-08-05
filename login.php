<?php $title = 'Login'; include 'partials/header.php'; ?>

<?php

checkIfUserIsLoggedInAndRedirect('/knowledgesheer/admin/');

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
	<div class="login-form col-md-4 col-12 p-3 border rounded">
		<h4>LOGIN</h4>
		<form class="" autocomplete="off" action="" method="POST">
			<div class="form-group">
				<input type="text" name="username" placeholder="username" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="password" name="password" placeholder="********" class="form-control" required>
			</div>
			<input type="submit" name="login" value="Log In" class="form-control btn btn-sm btn-primary">
		</form><hr>
		<p>New here: <a href="registration.php">Create Account</a></p>
	</div>
</div>

<?php include 'partials/footer.php'; ?>