<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['u_id'])) {
	$post_user_id = $_GET['u_id'];

	$query = "SELECT user_id, username, user_firstname, user_lastname, user_description FROM users WHERE user_id = ? ";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'i', $post_user_id);
	mysqli_stmt_execute($stmt);
	confirmQuery($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_description);
	mysqli_stmt_fetch($stmt);

	$full_name = $user_firstname . " " . $user_lastname;

$title = $full_name; 
$page = 'category';
$header_title = 'Knowledge Sheer';
include 'partials/header.php'; 


}
?>