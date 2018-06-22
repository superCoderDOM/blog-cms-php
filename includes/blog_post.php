<?php 

    if(isset($_GET['post_id'])) {

        $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);

    $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$post_id}";
        $updatePostViewCount = mysqli_query($connection, $query);
        if(!$updatePostViewCount) {

            die("QUERY FAILED: " . mysqli_error($connection));

        } else {

            $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $selectPostByID = mysqli_query($connection, $query);
            if(!$selectPostByID) {

                die("QUERY FAILED: " . mysqli_error($connection));

            } else {

                while($row = mysqli_fetch_assoc($selectPostByID)) {
        
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author_id = $row['post_author_id'];
                    $post_date = strtotime($row['post_date']);
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];

                    // Fetch author name
                    $query = "SELECT * FROM users WHERE user_id = $post_author_id";
                    $findUserAuthor = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($findUserAuthor);
                    $post_author_name = $row['user_firstname'] . " " . $row['user_lastname'];

                    ?>

                    <!-- Blog Post Content Column -->
                    <div class="col-lg-8">

                        <!-- Blog Post -->
        
                        <!-- Title -->
        
                        <?php
        
                            if($post_status === 'Published' || (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin')) {

                                ?>
            
                                <h1>
                                    <?php echo $post_title ?>
                                    <?php 
                                        if($post_status === 'Draft') {
                                            echo "<span class='badge'>DRAFT</span>";
                                        }
                                    ?>
                                </h1>
            
                                <!-- Author -->
                                <p class="lead">
                                    by <a href="./index.php?post_author_id=<?php echo $post_author_id; ?>"><?php echo $post_author_name; ?></a>
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
            
                                        $comment_post_id = mysqli_real_escape_string($connection, $post_id);
                                        $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                                        $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                                        $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
            
                                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content) ";
                                            $query .= "VALUES ('{$comment_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}')";
                                            $addComment = mysqli_query($connection, $query);
                                            if(!$addComment) {

                                                die('QUERY FAILED: ' . mysqli_error($connection));

                                            }

                                        } else {

                                            echo "<script>alert('Fields cannot be empty')</script>";
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

                                <?php 

                                    $query = "SELECT * FROM comments 
                                        WHERE comment_post_id = {$post_id} 
                                        AND comment_status = 'Approved' 
                                        ORDER BY comment_id DESC";
                                    $selectAllComments = mysqli_query($connection, $query);
                                    if(!$selectAllComments) {

                                        die('QUERY FAILED: ' . mysqli_error($connection));

                                    } else {

                                        while($row = mysqli_fetch_assoc($selectAllComments)) {
                
                                            $comment_author = $row['comment_author'];
                                            $comment_content = $row['comment_content'];
                                            $comment_date = strtotime($row['comment_date']);
                
                                            ?>
                
                                            <!-- Comment -->
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                                        <small><?php echo date('F j, Y \a\t g:i A', $comment_date); ?></small>
                                                    </h4>
                                                    <?php echo $comment_content; ?>
                                                </div>
                                            </div>
                
                                            <?php 
                                        }
                                    }
                            } else {
                                
                                echo "<h1> This post is currently unavailable </h1>"; 
                            }
                        ?>
                    </div>
        
                    <?php
                }
            }
        }
    } else {
        header("Location: index.php");
    }
?>

