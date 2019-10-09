<?php

$title = 'Dictionary';
$current_page = 'dictionary';
include 'partials/admin_header.php'; 

if (!is_admin($_SESSION['username'])) {
	redirect($baseURL . "/admin/index.php");
} else {

// Check source
if (isset($_GET['source'])) {
    $source = $_GET['source'];
} else {
    $source = '';
}

?>

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Dashboard</span>
		<h3 class="page-title">Dictionary</h3>
	</div>
</div>
<!-- End Page Header -->
<div class="row">
    <div class="col-12">
		<!-- switch case for changing pages -->
        <?php 

        switch ($source) {
            case 'edit_word':
                include 'dictionary_includes/edit_word.php';
                break;
                
            case 'add_word':
                include 'dictionary_includes/add_word.php';
                break;

            default:
                include 'dictionary_includes/view_all_words.php';
                break;
        }		

        ?>
	</div>
</div>

<?php include 'partials/admin_footer.php'; 
}
?>