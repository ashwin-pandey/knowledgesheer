<?php 

/*======================================================*/
/* COMMON REPETITIVE FUNCTIONS */
/*======================================================*/

function redirect($location){
    header("Location:" . $location);
    exit;
}

function query($query){
    global $connection;
    return mysqli_query($connection, $query);
}

function escape($string) {
	global $connection;
	return mysqli_real_escape_string($connection, trim($string));
}

function confirmQuery($result) {
	global $connection;
	if(!$result) {
		die("QUERY FAILED ." . mysqli_error($connection));
	}
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

/*======================================================*/
/* CHECK DUPLICATE USERS BY USERNAME AND EMAIL */
/*======================================================*/

function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exists($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

/*======================================================*/
/* REGISTER */
/*======================================================*/

function register_user($username, $email, $password){
	global $connection;

	$username = mysqli_real_escape_string($connection, $username);
	$email    = mysqli_real_escape_string($connection, $email);
	$password = mysqli_real_escape_string($connection, $password);

	$query = 'SELECT randSalt FROM users';
	$select_randsalt = query($query);
	confirmQuery($select_randsalt);

	$row = mysqli_fetch_assoc($select_randsalt);
	$salt = $row['randSalt'];

	$password = crypt($password, $salt);

	// $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));

	$query = "INSERT INTO users (username, user_password, user_email, user_role) ";
	$query .= "VALUES('{$username}', '{$password}', '{$email}', 'subscriber' )";
	$register_user_query = mysqli_query($connection, $query);

	confirmQuery($register_user_query);

	redirect("/knowledgesheer/index.php");

}


/*======================================================*/
/* LOGIN FUNCTIONALITIES */
/*======================================================*/

// Login User
function login_user($username, $password) {
	global $connection;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	$select_user_query = mysqli_query($connection, $query);
	confirmQuery($select_user_query);

	while ($row = mysqli_fetch_array($select_user_query)) {
		$db_user_id 		= $row['user_id'];
		$db_username 		= $row['username'];
		$db_user_password 	= $row['user_password'];
		$db_user_firstname 	= $row['user_firstname'];
		$db_user_lastname 	= $row['user_lastname'];
		$db_user_image		= $row['user_image'];
		$db_user_role		= $row['user_role'];
	}

	$password = crypt($password, $db_user_password);

	if ($username !== $db_username && $password !== $db_user_password) {
		redirect("/knowledgesheer/index.php");
	} else if ($username === $db_username && $password === $db_user_password) {
		$_SESSION['user_id'] = $db_user_id;
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;
		$_SESSION['user_image'] = $db_user_image;

		redirect("/knowledgesheer/admin/");
	} else {
		redirect("/knowledgesheer/index.php");
	}
}

// Check if Logged In
function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
	return false;
}

// Get the user id
function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
	if(isLoggedIn()){
		redirect($redirectLocation);
	}
}

function is_admin($username) {
	global $connection; 
	$query = "SELECT user_role FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);

	$row = mysqli_fetch_array($result);

	if($row['user_role'] == 'admin'){
		return true;
	} else {
		return false;
	}
}

/*======================================================*/
/* BLOG CATEGORIES */
/*======================================================*/

function insertCategory() {
	global $connection;
	// Insert Parent Category
	if(isset($_POST['create_category'])){
		$cat_title = $_POST['cat_title'];

		if($cat_title == "" || empty($cat_title)) {
			echo "This Field should not be empty";
		} else {
			$stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");
			mysqli_stmt_bind_param($stmt, 's', $cat_title);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
	}
	// Insert Sub Category
	if(isset($_POST['create_sub_category'])){
		$sub_cat_title = $_POST['sub_cat_title'];
		$parent_id = $_POST['parent_id'];

		if($sub_cat_title == "" || empty($cat_title)) {
			echo "This Field should not be empty";
		} else {
			$stmt = mysqli_prepare($connection, "INSERT INTO sub_categories(sub_cat_title, parent_cat_id) VALUES(?, ?) ");
			mysqli_stmt_bind_param($stmt, 'si', $sub_cat_title, $parent_id);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
	}
}

function deleteCategories() {
	global $connection;

	// if (isset($_GET['source']) === 'blog_categories') {
		if(isset($_GET['delete'])){
			$the_cat_id = $_GET['delete'];
			$query = 'SELECT * FROM sub_categories WHERE parent_cat_id = {$the_cat_id} ';
			$sub_categories = query($query);
			$count = mysqli_num_rows($sub_categories);

			if ($count == 0) {
				$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
				$delete_query = query($query);
				header("Location: blog.php?source=blog_categories");
			} else {
				echo "This Category has Sub-Categories, Plaese delete them first or reorder them and then try again!";
			}
		}
	// }
}

function deleteSubCategories() {
	global $connection;

	// if (isset($_GET['source']) === 'blog_categories') {
		if(isset($_GET['delete'])){
			$the_cat_id = $_GET['delete'];
			$query = 'SELECT post_id FROM blog_posts WHERE post_sub_category_id = {$the_cat_id} ';
			$sub_categories = query($query);
			$count = mysqli_num_rows($sub_categories);

			if ($count == 0) {
				$query = "DELETE FROM sub_categories WHERE sub_cat_id = {$the_cat_id} ";
				$delete_query = query($query);
				header("Location: blog.php?source=blog_categories");
			} else {
				echo "This Category has Posts, Plaese delete them first or reorder them and then try again!";
			}
		}
	// }
}

function updateCategories() {
	if(isset($_POST['update_category'])) {
		$update_cat_title = escape($_POST['cat_title']);
		$update_query = 'UPDATE categories SET cat_title = ?, cat_description = ? WHERE cat_id = ? ';
		$stmt = mysqli_prepare($connection, $update_query);
		confirmQuery($stmt);
		mysqli_stmt_bind_param($stmt, 'ssi', $update_cat_title, $cat_description, $cat_id);
		mysqli_stmt_execute($stmt);
		redirect("categories.php");
	}
	if(isset($_POST['update_sub_category'])) {
		$update_cat_title = escape($_POST['sub_cat_title']);
		$parent_cat_id = escape($_POST['parent_id']);
		$update_query = 'UPDATE sub_categories SET sub_cat_title = ?, parent_cat_id = ? WHERE sub_cat_id = ? ';
		$stmt = mysqli_prepare($connection, $update_query);
		confirmQuery($stmt);
		mysqli_stmt_bind_param($stmt, 'ssi', $update_cat_title, $parent_cat_id, $sub_cat_id);
		mysqli_stmt_execute($stmt);
		redirect("categories.php");
	}
}

// Estimated Read Time 
function read_time($post_content) {
	$word_count = str_word_count($post_content);
	$min = floor($word_count / 200);
	if ($min < 1) {
		return 1;
	} else {
		return $min;
	}
}

?>