<?php 
include 'includes/db.php';
include './admin/functions.php';

$title = 'Quotes'; 
$page = 'quotes';
include 'partials/header.php'; 

$query = "SELECT * FROM quotes";
$quote = query($query);
confirmQuery($quote);

while ($row = mysqli_fetch_assoc($quote)) {

$quote_content = $row['quote_content'];

?>

<?php echo $quote_content; ?>

<?php } include 'partials/footer.php' ?>