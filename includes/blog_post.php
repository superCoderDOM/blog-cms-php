<?php 

    if(isset($_GET['post_id'])) {

        $post_id = $_GET['post_id'];
        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $selectPostByID = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selectPostByID)) {

            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = strtotime($row['post_date']);
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

            ?>

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            
                <!-- Blog Post -->
            
                <!-- Title -->
                <h1><?php echo $post_title ?></h1>
            
                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>
            
                <hr>
            
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('F j, Y \a\t g:i A', $post_date); ?></p>
            
                <hr>
            
                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="featured blog post image">
            
                <hr>
            
                <!-- Post Content -->
                <p><?php echo $post_content; ?></p>
            
                <hr>
            
                <!-- Blog Comments -->
            
                <!-- Comments Form -->

                <?php 
                
                    if(isset($_POST['submit_comment'])) {
                
                        $comment_post_id = $post_id;
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        // $comment_status = 'Submitted';
                        // $comment_date = date('d-m-y');
            
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content) ";
                        $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}')";
            
                        $addComment = mysqli_query($connection, $query);

                        if(!$addComment) {
                            die('QUERY FAILED: ' . mysqli_error($connection));
                        }
                    }

                ?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author"> Name </label>
                            <input type="text" name="comment_author" id="comment_author" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="comment_email"> Email </label>
                            <input type="email" name="comment_email" id="comment_email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content"> Comment </label>
                            <textarea name="comment_content" id="comment_content" class="form-control" rows="3" placeholder="Enter your comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_comment"> Submit </button>
                    </form>
                </div>
            
                <hr>
            
                <!-- Posted Comments -->
            
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
            
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>
            
            </div>

            <?php
        }
    }
?>

