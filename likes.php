<?php 
include 'includes/db.php';

if (isset($_POST['liked'])) {
	$post_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$result = mysqli_query($connection, "SELECT likes FROM blog_posts WHERE post_id = $post_id");
	$row = mysqli_fetch_array($result);
	$n = $row['likes'];

	// Insert user_id and quote_id into quote_likes table
	$query = "INSERT INTO blog_likes (user_id, post_id) VALUES (?, ?)";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	// Update likes in quotes table
	$query1 = "UPDATE blog_posts SET likes=$n+1 WHERE post_id = ?";
	$stmt1 = mysqli_prepare($connection, $query1);
	mysqli_stmt_bind_param($stmt1, 'i', $post_id);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_close($stmt1);

	echo $n+1;
	exit();
}
if (isset($_POST['unliked'])) {
	$post_id = $_POST['post_id'];
	$user_id = $_POST['user_id'];
	$result = mysqli_query($connection, "SELECT * FROM blog_posts WHERE post_id = $post_id");
	$row = mysqli_fetch_array($result);
	$n = $row['likes'];

	$query = "DELETE FROM blog_likes WHERE post_id = ? AND user_id = ?";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'ii', $post_id, $user_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$query = "UPDATE blog_posts SET likes=$n-1 WHERE post_id = ?";
	$stmt1 = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt1, 'i', $post_id);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_close($stmt1);
	
	echo $n-1;
	exit();
}

?>