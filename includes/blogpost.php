<!-- First Blog Post -->
<?php 

    $query = "SELECT * FROM posts";
    $allPosts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($allPosts)) {

        // Save required fields to variables
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date =  strtotime($row['post_date']);
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        
        // Display post
        ?>
        
        <h2>
            <a href="#"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('F j, Y \a\t g:i A', $post_date); ?></p>
        <hr>
        <img class="img-responsive" src="images/<?php echo $post_image; ?> " alt="">
        <hr>
        <p><?php echo $post_content; ?></p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
        <hr>
    
        <?php  

    } 

?>
