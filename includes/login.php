<?php 

    require '../vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    include './db.php';

    session_start();

    if(isset($_POST['login'])) {

        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

        // Clean potential malicious SQL injections
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
        $selectUserByEmail = mysqli_query($connection, $query);
        if(!$selectUserByEmail){

            die('QUERY FAILED: ' . mysqli_error($connection));

        } else {

            while($row = mysqli_fetch_assoc($selectUserByEmail)) {

                if(password_verify($user_password, $row['user_password'])) {

                    $_SESSION['user_id'] = $row['user_id'];
                    // $_SESSION['username'] = $row['username'];
                    $_SESSION['user_firstname'] = $row['user_firstname'];
                    $_SESSION['user_lastname'] = $row['user_lastname'];
                    // $_SESSION['user_email'] = $row['user_email'];
                    $_SESSION['user_role'] = $row['user_role'];

                    header("Location: ../admin/index.php");  // redirects to CMS Administration Dashbpoard

                } else {

                    header("Location: ../index.php");  // redirects to homepage
                }
            }
        }
    }

?>