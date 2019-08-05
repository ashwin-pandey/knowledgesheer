<?php $title = 'Sign Up'; include "partials/header.php"; ?>
 
<?php

require './vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$options = array(
    'cluster' => 'ap2',
    'encrypted' => true
);

$pusher = new Pusher\Pusher(
    getenv('APP_KEY'), 
    getenv('APP_SECRET'), 
    getenv('APP_ID'), 
    $options
);

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = [
        'username'=> '',
        'email'=>'',
        'password'=>''
    ];

    if(strlen($username) < 4){
        $error['username'] = 'Username needs to be longer';
    }

    if($username ==''){
        $error['username'] = 'Username cannot be empty';
    }

    if(username_exists($username)){
        $error['username'] = 'Username already exists, pick another another';
    }

    if($email ==''){
        $error['email'] = 'Email cannot be empty';
    }

    if(email_exists($email)){
        $error['email'] = 'Email already exists, <a href="index.php">Please login</a>';
    }

    if($password == '') {
        $error['password'] = 'Password cannot be empty';
    }

    foreach ($error as $key => $value) {
        if(empty($value)){
            unset($error[$key]);
        }
    } // foreach

    if(empty($error)){
        register_user($username, $email, $password);
    }
} 

?>
    
<div class="row justify-content-md-center">
    <div class="login-form col-md-4 col-12 pm-3 border rounded">
        <h2>Sign Up</h2>
        <form raction="" method="post" autocomplete="off">
            <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                
                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
            
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>" >

                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">

                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>

            </div>

            <input type="submit" name="resgister" class="form-control btn btn-sm btn-primary" value="Register">
        </form>
        <hr>
        <p><a href="login.php"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back to Login</a></p>
    </div>
</div>

<?php include "partials/footer.php";?>