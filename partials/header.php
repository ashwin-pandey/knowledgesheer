<?php session_start(); ?>
<?php

if ($page == 'blog_post') {
	
} else {
	include 'includes/db.php';
	include './admin/functions.php';
}

?>

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
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

	<?php include 'navigation.php'; ?>

	<div class="container">

<a class="top-link hide" href="" id="js-top">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
  <!-- <span class="screen-reader-text">Back to top</span> -->
</a>