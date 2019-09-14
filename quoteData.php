<!-- For Lazy loading in quotes section! -->
<?php
include 'includes/db.php';
include './admin/functions.php';

if(!empty($_POST["id"])){
    //Get last ID
    $lastID = $_POST['id'];
    //Limit on data display
    $showLimit = 3;
    //Get all rows except already displayed
    $queryAll = query("SELECT * FROM quotes WHERE quote_id < ".$lastID." ORDER BY quote_id DESC");
    confirmQuery($queryAll);
    $rowAll = mysqli_fetch_assoc($queryAll);
    $allNumRows = mysqli_num_rows($queryAll);
    //Get rows by limit except already displayed
    $query = "SELECT quote_id, quote_image, quote_author, quote_date, quote_category, quote_content FROM quotes WHERE quote_id < ".$lastID." ORDER BY quote_id DESC LIMIT ".$showLimit;
    $count_query = query($query);
    $count = mysqli_num_rows($count_query);
    $quote_query = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($quote_query);
    mysqli_stmt_store_result($quote_query);
    mysqli_stmt_bind_result($quote_query, $quote_id, $quote_image, $quote_author, $quote_date, $quote_category, $quote_content);
    if($count > 0){
        while(mysqli_stmt_fetch($quote_query)){ 
            // User Query
            $query = "SELECT user_id, username, user_firstname, user_lastname, user_image FROM users WHERE username = ? ";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, 's', $quote_author);
            mysqli_stmt_execute($stmt);
            confirmQuery($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $user_id, $username, $user_firstname, $user_lastname, $user_image);
            mysqli_stmt_fetch($stmt);

            $full_name = $user_firstname . " " . $user_lastname;
    ?>

        <div class="card card-small mb-4">
            <div class="card-header border-0 pb-0">
                <div class="media post-author m-0 mb-2 align-self-center">
                    <img style="height: 40px; width: 40px;" src="assets/images/profile/<?php echo $user_image; ?>" alt="<?php echo $post_author; ?>" class="img-fluid mr-3 mt-0 rounded-circle">
                    <div class="media-body align-self-center">
                        <div class="user-name">
                            <a href="user_posts.php?u_id=<?php echo $user_id ?>"><?php echo $full_name; ?></a>
                        </div>
                        <div class="date">
                            <small style="font-size: 12px;"><?php echo date('F j, Y', strtotime($quote_date)); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-center p-0">
            <a style="cursor: pointer;" href="quote_page.php?q_id=<?php echo $quote_id; ?>"><img src="assets/images/quote-images/<?php echo $quote_image; ?>" class="img-fluid quote-image" alt="<?php echo $quote_hashtags; ?>"></a>
            </div>
            <div class="card-footer border-0 quote-content">
                <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-facebook" style="background-color: #ccc;">
                    <i class="fab fa-facebook-f" style="color: #fff;"></i>
                </a>
                <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-twitter" style="background-color: #ccc;">
                    <i class="fab fa-twitter" style="color: #fff;"></i>
                </a>
                <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-instagram" style="background-color: #ccc;">
                    <i class="fab fa-instagram" style="color: #fff;"></i>
                </a>
                <a style="cursor: pointer;" class="btn btn-md btn-social-icon btn-linkedin" style="background-color: #ccc;">
                    <i class="fab fa-linkedin-in" style="color: #fff;"></i>
                </a>
                <a href="assets/images/quote-images/<?php echo $quote_image; ?>" style="color: #fff;" class="btn btn-md btn-success" download><i class="fa fa-arrow-down"></i></a>
                <a href="quote_page.php?q_id=<?php echo $quote_id; ?>" style="color: #fff;" class="btn btn-md btn-primary"><i class="fa fa-arrow-right"></i></a>
                <br>
                <br>
                <?php echo $quote_content; ?>
            </div>
        </div>
    <?php } ?>
    <?php if($allNumRows > $showLimit){ ?>
        <div class="load-more text-center" lastID="<?php echo $quote_id; ?>" style="display: none;">
            <img src="loading.gif"/>
        </div>
    <?php } else { ?>
    <div class="load-more text-center" lastID="0">

    </div>
    <?php } } else { ?>
    <div class="load-more text-center" lastID="0">

    </div>
<?php } 
} ?>