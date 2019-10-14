<?php 

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

include './includes/db.php';
include './admin/functions.php';

echo '<urlset xmlns="https://sitemaps.org/schemas/sitemap/0.9">';

// Static links
echo '
<!-- static links -->
<url>
    <loc>http://knowledgesheer.com</loc></url>
    <changefreq>daily</changefreq>
<url>
    <loc>http://knowledgesheer.com/index</loc>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>http://knowledgesheer.com/quotes</loc>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>http://knowledgesheer.com/all_categories</loc>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>http://knowledgesheer.com/login</loc>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>http://knowledgesheer.com/registration</loc>
    <changefreq>weekly</changefreq>
</url>
';

echo '</urlset>';

?>