<?php 

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

include './includes/db.php';
include './admin/functions.php';

echo '<urlset xmlns="https://sitemaps.org/schemas/sitemap/0.9">';

// Categories
echo "<!-- Categories -->";
$cat_query = "SELECT cat_id, cat_slug FROM categories";
$cat_stmt = mysqli_prepare($connection, $cat_query);
mysqli_stmt_execute($cat_stmt);
confirmQuery($cat_stmt);
mysqli_stmt_store_result($cat_stmt);
mysqli_stmt_bind_result($cat_stmt, $cat_id, $cat_slug);

while (mysqli_stmt_fetch($cat_stmt)) {
    echo '
    <url>
        <loc>http://knowledgesheer.com/category/' . $cat_id . '/' . $cat_slug . '</loc>
        <changefreq>daily</changefreq>
    </url>
    ';
}


// Sub-Categories
echo "<!-- Sub-Categories -->";
$cat_query = "SELECT sub_cat_id, sub_cat_slug, parent_cat_id FROM sub_categories";
$sub_cat_stmt = mysqli_prepare($connection, $cat_query);
mysqli_stmt_execute($sub_cat_stmt);
confirmQuery($sub_cat_stmt);
mysqli_stmt_store_result($sub_cat_stmt);
mysqli_stmt_bind_result($sub_cat_stmt, $sub_cat_id, $sub_cat_slug, $parent_cat_id);

while (mysqli_stmt_fetch($sub_cat_stmt)) {
    $parent_slug = getCatSlug($parent_cat_id);
    echo '
    <url>
        <loc>http://knowledgesheer.com/sub_cat/' . $parent_slug . '/' . $sub_cat_id . '/' . $sub_cat_slug . '</loc>
        <changefreq>daily</changefreq>
    </url>
    ';
}

echo '</urlset>';

?>