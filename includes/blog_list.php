<!-- First Blog Post -->
<?php 

    $query = "SELECT * FROM posts";
    $allPosts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($allPosts)) {

        // Save required fields to variables
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date =  strtotime($row['post_date']);
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 300);
        
        // Display post
        ?>
        
        <h2>
            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php?author_id=$post_author_id"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('F j, Y \a\t g:i A', $post_date); ?></p>
        <hr>
        <a href="post.php?post_id=<?php echo $post_id; ?>">
            <img class="img-responsive" src="images/<?php echo $post_image; ?> " alt="">
        </a>
        <hr>
        <p><?php echo $post_content; ?></p>
        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
        <hr>
    
        <?php  

    } 

?>
