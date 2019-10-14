<?php 

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

include './includes/db.php';
include './admin/functions.php';

echo '<urlset xmlns="https://sitemaps.org/schemas/sitemap/0.9">';

$quote_query = "SELECT quote_id FROM quotes";
$quote_stmt = mysqli_prepare($connection, $quote_query);
mysqli_stmt_execute($quote_stmt);
confirmQuery($quote_stmt);
mysqli_stmt_store_result($quote_stmt);
mysqli_stmt_bind_result($quote_stmt, $quote_id);

while (mysqli_stmt_fetch($quote_stmt)) {
    echo '
    <url>
        <loc>http://knowledgesheer.com/quote_page.php?q_id=' . $quote_id . '</loc>
    </url>
    ';
}

echo '</urlset>';

?>