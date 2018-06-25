<?php 

    require '../vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include './db.php';
    include '../admin/functions.php';

    session_start();

    if(isset($_POST['login'])) {

        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);

        logUserIn($user_email, $user_password);
    }

?>