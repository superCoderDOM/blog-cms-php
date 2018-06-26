<?php 

    require './vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('./');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include './includes/db.php';
    include './admin/functions.php';

    session_start();

    checkIfUserIsLoggedInAndRedirect('./admin/index.php');

    if(ifItIsMethod('get')) {

        if(isset($_GET['email']) && isset($_GET['token'])) {

            $getEmail = escape($_GET['email']);
            $getToken = escape($_GET['token']);
    
            if($findUserTokenByEmail = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE user_email=?")) {

                mysqli_stmt_bind_param($findUserTokenByEmail, "s", $getEmail);
                mysqli_stmt_execute($findUserTokenByEmail);
                mysqli_stmt_bind_result($findUserTokenByEmail, $username, $user_email, $token);              
            }
            mysqli_stmt_fetch($findUserTokenByEmail);
            mysqli_stmt_close($findUserTokenByEmail);

            if($getToken !== $token || $getEmail !== $user_email) {

                redirect("./index.php");
            }

        } else {

            redirect("./index.php");
        }

    } elseif(ifItIsMethod('post') && isset($_POST['reset-submit']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    
        if(!empty($_POST['password1']) && !empty($_POST['password2'])) {

            if($_POST['password1'] === $_POST['password2']) {

                $email = escape($_GET['email']);
                $password = escape($_POST['password1']);
                $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                $resetUserPassword = mysqli_prepare($connection, "UPDATE users SET user_password = ?, token = '' WHERE user_email = ?");
                if(confirmQuery($resetUserPassword)) {

                    mysqli_stmt_bind_param($resetUserPassword, "ss", $hashed_password, $email);
                    mysqli_stmt_execute($resetUserPassword);

                    if(mysqli_stmt_affected_rows($resetUserPassword) === 1) {
                    
                        mysqli_stmt_close($resetUserPassword);
                        redirect("./login.php");
                        
                    } else {

                        $reset_message = "Oops, something went wrong, please try again!";
                    }
                }
                mysqli_stmt_close($resetUserPassword);

            } else {

                $reset_message = "Passwords do not match";
            }

        } else {

            $reset_message = "Password fields cannot be empty";
        }

    } else {
        
        redirect("./index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="description" content="Sign in form">
    <meta name="author" content="Dominic Lacroix">

    <title>Blog - Login</title>

    <?php include "./includes/header_meta_link.php"?>

</head>

<body>

    <!-- Page Content -->
    <div class="container">

        <?php include './includes/reset.php'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>