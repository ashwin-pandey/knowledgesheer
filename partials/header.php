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
	<meta name="subject" content="">
	<meta name="copyright"content="Knowledge Sheer">
	<meta name="language" content="EN">
	<meta name="robots" content="index,follow" />
	<meta name="abstract" content="">
	<meta name="topic" content="">
	<meta name="summary" content="">
	<meta name="Classification" content="Education">
	<meta name="author" content="knowledgesheer, knowledgesheer@gmail.com">
	<meta name="designer" content="">
	<meta name="copyright" content="KnowledgeSheer">
	<meta name="reply-to" content="knowledgesheer@gmail.com">
	<meta name="owner" content="Knowledge Sheer">
	<meta name="url" content="http://knowledgesheer.com">
	<meta name="identifier-URL" content="http://knowledgesheer.com">
	<meta name="directory" content="submission">
	<meta name="category" content="Education">
	<meta name="coverage" content="Worldwide">
	<meta name="distribution" content="Global">
	<meta name="rating" content="General">

	<link rel="stylesheet" type="text/css" href="./admin/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

	<header>
		<?php include 'navigation.php'; ?>
	</header>

	<div class="container">