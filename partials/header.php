<?php session_start(); ?>
<?php
if ($page == 'blog_post' || $page == 'category' || $page == 'user_posts' || $page == 'quotes') {
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
	<meta name="keywords" content="<?php echo $post_tags ?>"/>
	<meta name="description" content="<?php echo $post_description ?>"/>
	<meta property="og:title" content="<?php echo $post_title ?>">
	<meta property="og:url" content="http://knowledgesheer.com/blog_post.php?p_id=<?php echo $the_post_id; ?>" />
	<meta property="og:description" content="<?php echo $post_description; ?>" />
	<meta property="og:site_name" content="Knowledge Sheer" />
	<meta property="og:image" content="http://knowledgesheer.com/assets/images/blog-images/<?php echo $post_image; ?>" />
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
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
<body>

	<?php include 'navigation.php'; ?>

	<div class="container">

<a class="top-link hide" href="" id="js-top">
  <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg> -->
  <svg viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
</a>