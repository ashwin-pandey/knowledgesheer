<?php 
include 'includes/db.php';
include './admin/functions.php';

if (isset($_POST['liked'])) {
	$quote_id = $_POST['quote_id'];
	$user_id = $_POST['user_id'];
	$result = query("SELECT * FROM quotes WHERE quote_id=$quote_id");
	$row = mysqli_fetch_array($result);
	$n = $row['likes'];

	query("INSERT INTO quote_likes (user_id, quote_id) VALUES ($user_id, $quote_id)");
	query("UPDATE quotes SET likes=$n+1 WHERE quote_id=$quote_id");

	echo $n+1;
	exit();
}
if (isset($_POST['unliked'])) {
	$quote_id = $_POST['quote_id'];
	$user_id = $_POST['user_id'];
	$result = query("SELECT * FROM quotes WHERE quote_id=$quote_id");
	$row = mysqli_fetch_array($result);
	$n = $row['likes'];

	query("DELETE FROM quote_likes WHERE quote_id=$quote_id AND user_id=$user_id");
	query("UPDATE quotes SET likes=$n-1 WHERE quote_id=$quote_id");
	
	echo $n-1;
	exit();
}

// Retrieve posts from the database
$quotes = query("SELECT * FROM quotes");

?>