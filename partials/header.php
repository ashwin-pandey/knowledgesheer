<?php session_start(); ?>
<?php
if ($page == 'blog_post' || $page == 'category' || $page == 'sub_category' || $page == 'user_posts' || $page == 'quotes') {
} else {
	include 'includes/db.php';
	include './admin/functions.php';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if($page == 'home') { ?>
	<title>Home | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share"/>
	<meta name="description" content=""/>
	<meta property="og:title" content="Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com" />
	<meta property="og:description" content="" />
	<?php } if ($page == 'quotes') { ?>
	<title>Quotes | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share, quotes"/>
	<meta name="description" content=""/>
	<meta property="og:title" content="Quotes | Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com/quotes.php" />
	<meta property="og:description" content="" />
	<?php } if ($page == 'blog_post') { ?>
	<title><?php echo $post_title; ?> | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share, <?php echo $post_tags; ?>"/>
	<meta name="description" content="<?php echo $post_description; ?>"/>
	<meta property="og:title" content="<?php echo $post_title; ?> | Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com/blog_post.php?p_id=<?php echo $the_post_id; ?>" />
	<meta property="og:description" content="<?php echo $post_description; ?>" />
	<meta property="og:image" content="http://knowledgesheer.com/assets/images/blog-images/<?php echo $post_image; ?>" />
	<?php } if ($page == 'category') { ?>
	<title><?php echo $cat_title; ?> | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share, <?php echo $cat_title; ?>"/>
	<meta name="description" content="<?php echo $cat_description; ?>"/>
	<meta property="og:title" content="<?php echo $cat_title; ?> | Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com/category.php?category=<?php echo $post_category_id; ?>" />
	<meta property="og:description" content="<?php echo $cat_description; ?>" />
	<meta property="og:image" content="http://knowledgesheer.com/assets/images/cat-images/<?php echo $cat_image; ?>" />
	<?php } if ($page == 'sub_category') { ?>
	<title><?php echo $sub_cat_title; ?> | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share, <?php echo $cat_title; ?>"/>
	<meta name="description" content="<?php echo $sub_cat_description; ?>"/>
	<meta property="og:title" content="<?php echo $sub_cat_title; ?> | Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com/category.php?sub_category=<?php echo $post_category_id; ?>" />
	<meta property="og:description" content="<?php echo $sub_cat_description; ?>" />
	<meta property="og:image" content="http://knowledgesheer.com/assets/images/cat-images/<?php echo $sub_cat_image; ?>" />
	<?php } if ($page == 'all_categories') { ?>
	<title>Categories | Knowledge Sheer</title>
	<meta name="keywords" content="Knowledgesheer, knowledge, share, categories"/>
	<meta name="description" content=""/>
	<meta property="og:title" content="Categories | Knowledge Sheer">
	<meta property="og:url" content="http://knowledgesheer.com/all_categories.php" />
	<meta property="og:description" content="" />" />
	<?php } ?>
	<meta property="og:site_name" content="Knowledge Sheer" />
	<meta name="language" content="EN">
	<meta name="robots" content="index,follow" />
	<link href="assets/images/favicon/favicon.ico" rel="icon">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href='assets/css/lora-font.css' rel='stylesheet'>
	<link href='assets/css/open-sans-font.css' rel='stylesheet'>
	<link href="assets/css/clean-blog.min.css" rel="stylesheet">
	<link href="assets/css/owl.carousel.css" rel="stylesheet">
	<link href="assets/css/owl.theme.default.css" rel="stylesheet">
	<link href="./assets/css/style.css" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
</head>
<body>
	<?php include 'navigation.php'; ?>
	<div class="container">
		<a class="top-link hide" href="" id="js-top">
			<svg viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
		</a>