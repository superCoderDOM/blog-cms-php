<!-- Admin Panel Widgets -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 

                            $query = "SELECT * FROM posts";
                            $selectAllPosts = mysqli_query($connection, $query);
                            $post_count = mysqli_num_rows($selectAllPosts);

                            echo "<div class='huge'>{$post_count}</div>";

                        ?>
                        <div> Posts </div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left"> View Details </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 

                        $query = "SELECT * FROM comments";
                        $selectAllComments = mysqli_query($connection, $query);
                        $comment_count = mysqli_num_rows($selectAllComments);

                        echo "<div class='huge'>{$comment_count}</div>";

                    ?>
                  <div> Comments </div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left"> View Details </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 

                        $query = "SELECT * FROM users";
                        $selectAllUsers = mysqli_query($connection, $query);
                        $user_count = mysqli_num_rows($selectAllUsers);

                        echo "<div class='huge'>{$user_count}</div>";

                    ?>
                    <div> Users </div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left"> View Details </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 

                        $query = "SELECT * FROM categories";
                        $selectAllCategories = mysqli_query($connection, $query);
                        $category_count = mysqli_num_rows($selectAllCategories);

                        echo "<div class='huge'>{$category_count}</div>";

                    ?>
                     <div> Categories </div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left"> View Details </span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Google Chart -->
<?php

    $query = "SELECT * FROM posts WHERE post_status = 'Published'";
    $selectAllPublishedPosts = mysqli_query($connection, $query);
    $post_published_count = mysqli_num_rows($selectAllPublishedPosts);

    $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
    $selectAllDraftPosts = mysqli_query($connection, $query);
    $post_draft_count = mysqli_num_rows($selectAllDraftPosts);

    $query = "SELECT * FROM comments WHERE comment_status = 'Submitted'";
    $selectAllSubmittedComments = mysqli_query($connection, $query);
    $comment_submitted_count = mysqli_num_rows($selectAllSubmittedComments);

    $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
    $selectAllSubscriberUsers = mysqli_query($connection, $query);
    $user_subscriber_count = mysqli_num_rows($selectAllSubscriberUsers);

?>

<div class="row">
    <div class="col-12">
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
                <?php 

                    $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'All Comments', 'Submitted Comments', 'All Users', 'Subscribers', 'Categories'];
                    $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $comment_submitted_count, $user_count, $user_subscriber_count, $category_count];
                    $element_length = count($element_text);

                    for($i = 0; $i < $element_length; $i++) {

                        echo "['{$element_text[$i]}', {$element_count[$i]}],";

                    }

                ?>
                ]);

                var options = {
                chart: {
                    title: 'Blog Performance',
                    subtitle: 'Posts, Comments, Users, and Categories',
                }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
    </div>
</div>
