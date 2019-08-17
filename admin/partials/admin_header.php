<?php ob_start(); ?>
<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>

<?php 

if(isset($_SESSION['user_role']) != 'admin') {
	// if (!is_admin($_SESSION['username'])) {
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

	<link rel="icon" href="../assets/images/favicon/favicon.ico" type="image/x-icon">
	
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">

	<!-- font-family -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

	<!-- icons -->
	<link rel="stylesheet" type="text/css" href="./assets/icons/all.css">

	<link rel="stylesheet" href="./assets/css/extras.1.1.0.min.css">
	<link rel="stylesheet" href="./assets/css/shards-dashboards.1.1.0.min.css">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

<!-- complete page -->
<!-- <div class="wrapper">
	<?php // include 'admin_navigation.php'; ?> -->

<body class="h-100">
    <div class="container-fluid">
    	<div class="row">
    		<?php include 'admin_navigation.php'; ?>