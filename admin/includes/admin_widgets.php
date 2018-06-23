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
                        <div class='huge'><?php echo $post_count = allRecordsCount('posts'); ?></div>
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
                        <div class='huge'><?php echo $comment_count = allRecordsCount('comments'); ?></div>
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
                        <div class='huge'><?php echo $user_count = allRecordsCount('users'); ?></div>
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
                        <div class='huge'><?php echo $category_count = allRecordsCount('categories'); ?></div>
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
    $post_published_count = selectRecordsCount('posts', 'post_status', 'Published');
    $post_draft_count = selectRecordsCount('posts', 'post_status', 'Draft');
    $comment_submitted_count = selectRecordsCount('comments', 'comment_status', 'Submitted');
    $user_subscriber_count = selectRecordsCount('users', 'user_role', 'Subscriber');
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
