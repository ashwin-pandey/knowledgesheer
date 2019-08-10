<?php 

include 'includes/db.php';
include './admin/functions.php';

if (isset($_GET['p_id'])) {
	$the_post_id = $_GET['p_id'];

	$stmt1 = mysqli_prepare($connection , "SELECT post_title, post_author, post_date, post_image, post_content, post_tags, post_description FROM blog_posts WHERE post_id = ? AND post_status = ? ");
	$published = 'public';

	mysqli_stmt_bind_param($stmt1, "is", $the_post_id, $published);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_bind_result($stmt1, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_description);

	$stmt = $stmt1;

	while(mysqli_stmt_fetch($stmt)) {

?>


<?php 

$title = '$post_title'; 
$page = 'blog_post';
include 'partials/header.php'; 

?>

<div class="row">
	<!-- <div class="col-lg-7 col-md-8 mx-auto"> -->
	<div class="col-md-8 col-md-offset-2 col-xs-12 mx-auto">
		<?php echo stripcslashes($post_content); ?>
	</div>
</div>

<?php 
	}
} 

include './partials/footer.php';

?>