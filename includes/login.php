<?php 

    require '../vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include 'db.php';

    session_start();

    if(isset($_POST['login'])) {

        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // Clean potential malicious SQL injections
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
        $selectUserByID = mysqli_query($connection, $query);
        if(!$selectUserByID){

            die('QUERY FAILED: ' . mysqli_error($connection));

        } else {

            while($row = mysqli_fetch_assoc($selectUserByID)) {

                if($user_email === $row['user_email'] && $user_password === $row['user_password']) {

                    $_SESSION['username'] = $row[' $username'];
                    $_SESSION['user_firstname'] = $row['user_firstname'];
                    $_SESSION['user_lastname'] = $row['user_lastname'];
                    $_SESSION['user_role'] = $row['user_role'];

                    header("Location: ../admin/index.php");  // redirects to CMS Administration Dashbpoard

                } else {

                    header("Location: ../index.php");  // redirects to homepage
                }
            }
        }
    }

?>