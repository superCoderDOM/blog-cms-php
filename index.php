<?php 

    require __DIR__ . '/vendor/autoload.php';


    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD']);

    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="description" content="Blog landing page">
    <meta name="author" content="Dominic Lacroix">

    <title>Blog - Home</title>

    <?php include "./includes/header_meta_link.php"?>

</head>

<body>

    <?php include './includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php include './includes/content.php'; ?>
            <?php include './includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

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