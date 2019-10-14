<?php 

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

include './includes/db.php';
include './admin/functions.php';

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<!-- static links -->
<url>
    <loc>http://knowledgesheer.com</loc></url>
<url>
    <loc>http://knowledgesheer.com/index</loc>
</url>
<url>
    <loc>http://knowledgesheer.com/quotes</loc>
</url>
<url>
    <loc>http://knowledgesheer.com/all_categories</loc>
</url>
<url>
    <loc>http://knowledgesheer.com/login</loc>
</url>
<url>
    <loc>http://knowledgesheer.com/registration</loc>
</url>

</urlset>
';

?>