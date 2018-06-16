<!-- Blog Entries Column -->
<div class="col-md-8">

    <?php 

        $postsPerPage = 5;

        if((isset($_POST['search_submit']) && isset($_POST['search'])) || isset($_GET['search'])) {

            if(isset($_POST['search'])) {
                $search = $_POST['search'];
            } else {
                $search = $_GET['search'];
            }

            ?>
                <h1 class="page-header">
                    Blog Posts
                    <small>related to <?php echo $search; ?></small>
                </h1>
            <?php

            include './includes/blog_search_list.php';

        } elseif(isset($_GET['cat_id'])) {

            $cat_id = $_GET['cat_id'];
            $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
            $selectCategoryByID = mysqli_query($connection, $query);
            if(!$selectCategoryByID) {

                die("QUERY FAILED: " . mysqli_error($connection));
        
            } else {
        
                while($row = mysqli_fetch_assoc($selectCategoryByID)) {

                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    ?>
                    <h1 class="page-header">
                        Blog Posts
                        <small>related to <?php echo $cat_title; ?></small>
                    </h1>
                    <?php

                    include './includes/blog_category_list.php';
                }
            }

        }elseif(isset($_GET['post_author'])) {
            $post_author = $_GET['post_author'];

            ?>
            <h1 class="page-header">
                Blog Posts
                <small>written by <?php echo $post_author; ?></small>
            </h1>
            <?php

            include './includes/blog_author_list.php';

        } else {

            ?>
                <h1 class="page-header">
                    Most Recent Posts
                    <small>All categories</small>
                </h1>
            <?php

            include './includes/blog_list.php';

        }
    ?>
</div>
