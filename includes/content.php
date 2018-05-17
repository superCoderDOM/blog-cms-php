<!-- Blog Entries Column -->
<div class="col-md-8">

    
    <?php 
        if(isset($_POST['submit']) && isset($_POST['search'])) {

            ?>
                <h1 class="page-header">
                    Search Results
                    <small>Posts related to <?php echo $_POST['search']; ?></small>
                </h1>
            <?php

            include 'includes/blog_search_list.php';

        } else {

            ?>
                <h1 class="page-header">
                    Most Recent Posts
                    <small>All categories</small>
                </h1>
            <?php

            include 'includes/blog_list.php';

        }
    ?>
    <?php include 'includes/pager.php'; ?>

</div>
