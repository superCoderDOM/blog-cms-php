<?php ob_start(); ?>
<?php 

    require '../vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include "../includes/db.php";
    include "functions.php";

?>