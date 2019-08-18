<?php ob_start(); ?>
<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>

<?php 

// if(isset($_SESSION['user_role']) != 'admin') {
if (!is_admin($_SESSION['username'])) {
	redirect("/knowledgesheer/index.php");
	// }
}
// else {
// 	header("location: ../index.php");
// }

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> | Knowledge Sheer</title>
	<meta name="robots" content="noindex, nofollow">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../assets/images/favicon/favicon.ico" type="image/x-icon">
</head>
	<link href="assets/css/fontawesome-5.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/extras.1.1.0.min.css">
	<link rel="stylesheet" href="assets/css/shards-dashboards.1.1.0.min.css">
	<link href="assets/css/datatables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<body>

<!-- complete page -->
<!-- <div class="wrapper">
	<?php // include 'admin_navigation.php'; ?> -->

<body class="h-100">
    <div class="container-fluid">
    	<div class="row">
    		<?php include 'admin_navigation.php'; ?>