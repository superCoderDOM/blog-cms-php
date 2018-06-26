<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <?php 
        if(!isset($_SESSION['user_id'])) {

            ?>
            <!-- Blog Login Well -->
            <div class="well">
                <h4>Sign In</h4>
                <form action="./login.php" method="post">
                    <div class="form-group">
                        <input type="email" name="user_email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="input-group">
                        <input type="password" name="user_password" class="form-control" placeholder="Enter your password" autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit"> Login </button>
                        </span>
                    </div>
                </form>
            </div>
            <?php
        }
    ?>

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="./index.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button type="submit" name="search_submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
            <!-- /.input-group -->
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php 

                        $query = "SELECT * FROM categories";
                        $allCategories = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($allCategories)) {

                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<li><a href='./index.php?cat_id={$cat_id}'>{$cat_title}</a></li>";

                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>