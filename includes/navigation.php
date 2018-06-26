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

                    $pageName = basename($_SERVER['PHP_SELF']);

                    $query = "SELECT * FROM categories";
                    $allCategories = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($allCategories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        $cat_class = '';
                        if(isset($_GET['cat_id']) && $cat_id === $_GET['cat_id']) {
                            $cat_class = 'active';
                        }
                        echo "<li class='{$cat_class}'><a href='./index.php?cat_id={$cat_id}'> {$cat_title} </a></li>";
                    }

                    $contact_class = '';
                    if($pageName === 'contact.php') {
                        $contact_class = 'active';
                    }
                    echo "<li class='{$contact_class}'><a href='./contact.php'> Contact </a></li>";

                    if(isset($_SESSION['user_role'])) {

                        if($_SESSION['user_role'] === 'Admin' || $_SESSION['user_role'] === 'Contributor') {

                            echo "<li><a href='./admin/index.php'> Admin </a></li>";

                            if(isset($_GET['post_id'])) {

                                $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
                                echo "<li><a href='./admin/posts.php?source=edit_post&edit_post_id={$post_id}'> Edit Post </a></li>";
                            }
                        }

                    } else {

                        $regist_class = '';
                        $login_class = '';
                        if($pageName === 'registration.php') {
                            $regist_class = 'active';
                        } elseif($pageName === 'login.php') {
                            $login_class = 'active';
                        }
                        echo "<li class='{$regist_class}'><a href='./registration.php'> Register </a></li>";
                        echo "<li class='{$login_class}'><a href='./login.php'> Login </a></li>";
                    }

                    if(isset($_SESSION['user_id'])) {

                        if(empty($_SESSION['user_firstname']) && empty($_SESSION['user_lastname'])) {
                            $user_name = $_SESSION['username'];
                        } else {
                            $user_name = $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];
                        }
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="./admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="./admin/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
