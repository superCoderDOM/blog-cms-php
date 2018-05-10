<!-- Blog Post -->
<?php

    // Fetch all posts with tags like search keyword
    $search =  $_POST['search'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
    $searchPostTags = mysqli_query($connection, $query);

    if(!$searchPostTags) {

        die("QUERY FAILED: " . mysqli_error($connection));

    } else {

        $count = mysqli_num_rows($searchPostTags);

        if($count == 0) {

            echo "<h2>No Results</h2>";

        } else {

            while($row = mysqli_fetch_assoc($searchPostTags)) {

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
        }
    }
?>
