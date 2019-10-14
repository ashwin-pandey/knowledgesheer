<?php 

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

include './includes/db.php';
include './admin/functions.php';

echo '<urlset xmlns="https://sitemaps.org/schemas/sitemap/0.9">';

$query = "SELECT post_id, post_slug FROM blog_posts";
$blog_stmt = mysqli_prepare($connection, $query);
mysqli_stmt_execute($blog_stmt);
confirmQuery($blog_stmt);
mysqli_stmt_store_result($blog_stmt);
mysqli_stmt_bind_result($blog_stmt, $post_id, $post_slug);

while (mysqli_stmt_fetch($blog_stmt)) {
    echo '
    <url>
        <loc>http://knowledgesheer.com/blog_post/' . $post_id . '/' . $post_slug . '</loc>
        <changefreq>daily</changefreq>
    </url>
    ';
}

echo '</urlset>';

?>