<?php session_start(); ?>
<?php include 'includes/db.php'; ?>
<?php include './admin/functions.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> | Knowledge Sheer</title>
	<link rel="stylesheet" type="text/css" href="./admin/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

	<header>
		<?php include 'navigation.php'; ?>
	</header>

	<div class="container">