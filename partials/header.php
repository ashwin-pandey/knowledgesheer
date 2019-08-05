<?php session_start(); ?>
<?php include 'includes/db.php'; ?>
<?php include './admin/functions.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> | Knowledge Sheer</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords ?>"/>
	<meta name="description" content="<?php echo $keywords ?>"/>
	<meta name="language" content="EN">
	<meta name="robots" content="index,follow" />

	<!-- Bootstrap core CSS -->
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom fonts for this template -->
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<!-- Custom styles for this template -->
	<link href="assets/css/clean-blog.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="./assets/css/style.css"> -->
</head>
<body>

	<?php include 'navigation.php'; ?>

	<div class="container">