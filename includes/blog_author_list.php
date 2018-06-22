<!-- Blog Post List -->
<?php

    $post_author_id = mysqli_real_escape_string($connection, $post_author_id);

    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

        $query = "SELECT * FROM posts 
            WHERE post_author_id = $post_author_id";
    } else {

        $query = "SELECT * FROM posts 
            WHERE post_author_id = $post_author_id 
            AND post_status = 'Published'";
    }
    $fetchAllAuthorPosts = mysqli_query($connection, $query);
    if(!$fetchAllAuthorPosts) {

        die("QUERY FAILED: " . mysqli_error($connection));

    } else {

        $postCount = mysqli_num_rows($fetchAllAuthorPosts);
        $pages = ceil($postCount / $postsPerPage);

        if(isset($_GET['page'])) {
            $page = mysqli_real_escape_string($connection, $_GET['page']);
        } else {
            $page = 1;
        }

        if($page == 1) {
            $firstPost = 0;
        } else {
            $firstPost = ($page * $postsPerPage) - $postsPerPage;
        }

        if($postCount < 1) {

            echo "<h2> No Posts Available </h2>";

        } else {
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

                $query = "SELECT * FROM posts 
                    WHERE post_author_id = {$post_author_id} 
                    ORDER BY post_id DESC 
                    LIMIT $firstPost, $postsPerPage";
            } else {

                $query = "SELECT * FROM posts 
                    WHERE post_author_id = {$post_author_id} 
                    AND post_status = 'Published' 
                    ORDER BY post_id DESC 
                    LIMIT $firstPost, $postsPerPage";
            }
            $selectPostsByAuthor = mysqli_query($connection, $query);
            if(!$selectPostsByAuthor) {
    
                die("QUERY FAILED: " . mysqli_error($connection));
    
            } else {
    
                $count = mysqli_num_rows($selectPostsByAuthor);
        
                if($count == 0) {
        
                    echo "<h2>No Results</h2>";
        
                } else {
        
                    while($row = mysqli_fetch_assoc($selectPostsByAuthor)) {
        
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author_id = $row['post_author_id'];
                        $post_date =  strtotime($row['post_date']);
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 300);
                        $post_status = $row['post_status'];

                        // Fetch author name
                        $query = "SELECT * FROM users WHERE user_id = {$post_author_id}";
                        $findUserAuthor = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($findUserAuthor);
                        $post_author_name = $row['user_firstname'] . " " . $row['user_lastname'];
                        ?>
        
                        <h2>
                            <a href="./post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            <?php 
                            if($post_status === 'Draft') {
                                echo "<span class='badge'>DRAFT</span>";
                            }
                        ?>
                        </h2>
                        <p class="lead">
                            by <?php echo $post_author_name; ?>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('F j, Y \a\t g:i A', $post_date); ?></p>
                        <hr>
                        <a href="./post.php?post_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image; ?> " alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="./post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
                        <?php 
                    }
                }
            }
        }
    }
?>

<!-- Pager -->
<ul class="pager">
    <?php 
        if($page > 1) {
            $prevPage = $page - 1;
            echo "<li class='previous'><a href='./index.php?post_author_id={$post_author_id}&page={$prevPage}'>&larr; Previous</a></li>";
        }

        for($i = 1; $i <= $pages; $i++) {
            if($i == $page || ($i == 1 && $page == "")) {
                echo "<li><a class='active_link' href='./index.php?post_author_id={$post_author_id}&page={$i}'> {$i} </a></li>";
            } else {
                echo "<li><a href='./index.php?post_author_id={$post_author_id}&page={$i}'> {$i} </a></li>";
            }
        }

        if($page < $pages) {
            $nextPage = $page + 1;
            echo "<li class='next'><a href='./index.php?post_author_id={$post_author_id}&page={$nextPage}'>Next &rarr;</a></li>";
        }
    ?>
</ul>