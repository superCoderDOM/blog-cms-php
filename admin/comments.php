<?php include './includes/admin_header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="description" content="Comments management area">
    <meta name="author" content="Dominic Lacroix">

    <title>CMS Admin - Posts</title>

    <?php include "./includes/admin_metaLink.php"; ?>

</head>

<body>

    <div id="wrapper">

        <?php include "./includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php include "./includes/admin_comments.php"; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include './includes/admin_scripts.php' ?>

</body>

</html>
