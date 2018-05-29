<?php 

    require '../vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    ob_start();
    session_start();

    include "../includes/db.php";
    include "./functions.php";

    if(isset($_SESSION['user_role'])) {
        if($_SESSION['user_role'] !== 'Admin') {
            header("Location: ../index.php");
        }
    // } else {
        // header("Location: ../index.php");
    }

?>