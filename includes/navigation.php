<?php include 'includes/db.php'; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">superCoderDOM</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php 
                
                    $query = "SELECT * FROM categories";
                    $allCategories = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($allCategories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='./index.php?cat_id={$cat_id}'> {$cat_title} </a></li>";
                    }

                    if(isset($_SESSION['user_role'])) {

                        if($_SESSION['user_role'] === 'Admin') {

                            echo "<li><a href='./admin/index.php'> Admin </a></li>";

                            if(isset($_GET['post_id'])) {

                                $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
                                echo "<li><a href='./admin/posts.php?source=edit_post&edit_post_id={$post_id}'> Edit Post </a></li>";
                            }
                        }

                    } else {

                        echo "<li><a href='./registration.php'>Register</a></li>";
                    }
                ?>
                <li><a href='./contact.php'> Contact </a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
