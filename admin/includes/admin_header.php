<?php 

    ob_start();

    require '../vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    session_start();

    include "../includes/db.php";
    include "./functions.php";

    if(!isset($_SESSION['user_role'])) {

        header("Location: ../index.php");
    }

?>