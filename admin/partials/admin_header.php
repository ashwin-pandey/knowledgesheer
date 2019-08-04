<?php ob_start(); ?>
<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>

<?php 

if(isset($_SESSION['user_role'])) {
	if (!is_admin($_SESSION['username'])) {
		redirect("location: /knowledgesheer/index.php");
	}
}
// else {
// 	header("location: ../index.php");
// }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">

	<!-- font-family -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

	<!-- icons -->
	<link rel="stylesheet" type="text/css" href="./assets/icons/all.css">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

<!-- complete page -->
<div class="wrapper">
	<?php include 'admin_navigation.php'; ?>