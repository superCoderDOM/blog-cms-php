<?php 

    require './vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('./');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include './includes/db.php';
    include './admin/functions.php';

    session_start();

    checkIfUserIsLoggedInAndRedirect('./admin/index.php');

    if(ifItIsMethod('post') && isset($_POST['login']) && isset($_POST['user_email']) && isset($_POST['user_password'])) {

        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);

        logUserIn($user_email, $user_password);
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

    <?php include './includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <?php include './includes/login.php'; ?>

        <hr>

        <?php include './includes/footer.php'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>