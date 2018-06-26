<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <?php if($_SESSION['user_role'] === 'Admin' || $_SESSION['user_role'] === 'Contributor'): ?>

            <li>
                <a href="./index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#post-dropdown"><i class="fa fa-fw fa-file-text"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="post-dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View All Posts</a>
                    </li>
                    <li>
                        <a href="./posts.php?source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>

            <?php if($_SESSION['user_role'] === 'Admin'): ?>
                <li>
                    <a href="./comments.php"><i class="fa fa-fw fa-comments"></i> Comments </a>
                </li>
            <?php endif; ?>

            <li>
                <a href="./categories.php"><i class="fa fa-fw fa-list"></i> Categories </a>
            </li>

            <?php if($_SESSION['user_role'] === 'Admin'): ?>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="users" class="collapse">
                        <li>
                            <a href="./users.php">View All Users</a>
                        </li>
                        <li>
                            <a href="./users.php?source=add_user">Add User</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

        <?php endif; ?>

        <li>
            <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile </a>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->