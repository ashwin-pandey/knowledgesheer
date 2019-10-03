<?php ob_start(); ?>
<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php session_start(); ?>

<?php 

// if (!is_admin($_SESSION['username'])) {
// 	redirect("/index.php");
// }

if (is_admin($_SESSION['username']) || is_editor($_SESSION['username'])) {
	
} else {
	redirect($baseURL . "/index");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> | Knowledge Sheer</title>
	<meta name="robots" content="noindex, nofollow">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo $baseURL; ?>/assets/images/favicon/favicon.ico" type="image/x-icon">
</head>
	<link href="<?php echo $baseURL; ?>/admin/assets/css/bootstrap.min.css" rel="stylesheet" >
	<link href="<?php echo $baseURL; ?>/admin/assets/css/datatables.bootstrap4.min.css" rel="stylesheet">
	<link href="<?php echo $baseURL; ?>/admin/assets/css/fontawesome-5.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo $baseURL; ?>/assets/css/open-sans-font.css" rel="stylesheet">
	<link href="<?php echo $baseURL; ?>/admin/assets/css/quicksand-font.css" rel="stylesheet">
	<link href="<?php echo $baseURL; ?>/admin/assets/css/extras.1.1.0.min.css" rel="stylesheet" >
	<link href="<?php echo $baseURL; ?>/admin/assets/css/shards-dashboards.1.1.0.min.css" rel="stylesheet" >
	<link href="<?php echo $baseURL; ?>/admin/assets/css/style.css" rel="stylesheet">
<!-- <body> -->

<!-- complete page -->
<!-- <div class="wrapper">
	<?php // include 'admin_navigation.php'; ?> -->

<body class="h-100">
    <div class="container-fluid">
    	<div class="row">
    		<?php include 'admin_navigation.php'; ?>