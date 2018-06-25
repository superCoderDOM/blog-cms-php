<?php 
    include './includes/admin_header.php';
    if($_SESSION['user_role'] !== 'Admin') {
        redirect('./profile.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="description" content="Categories management area">
    <meta name="author" content="Dominic Lacroix">

    <title>CMS Admin - Categories</title>

    <?php include "./includes/admin_meta_link.php"; ?>

</head>

<body>

    <div id="wrapper">

        <?php include "./includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php include "./includes/admin_categories.php"; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include './includes/admin_scripts.php' ?>

</body>

</html>
