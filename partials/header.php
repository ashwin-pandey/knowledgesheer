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
</head>
	<link href="assets/images/favicon/favicon.ico" rel="icon">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href='assets/css/lora-font.css' rel='stylesheet'>
	<link href='assets/css/open-sans-font.css' rel='stylesheet'>
	<link href="assets/css/clean-blog.min.css" rel="stylesheet">
	<link href="./assets/css/style.css" rel="stylesheet" >
<body>

	<?php include 'navigation.php'; ?>

	<div class="container">

<a class="top-link hide" href="" id="js-top">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
  <!-- <span class="screen-reader-text">Back to top</span> -->
</a>