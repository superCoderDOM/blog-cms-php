<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">

        <h1 class="page-header"> Blog Posts </h1>

        <?php 

            if(isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = '';
            }

            // Display only requested posts
            switch($source) {
                case 'add_post' :
                    include 'includes/forms/create_post.php';
                    break;
                case 'edit_post' :
                    include 'includes/forms/update_post.php';
                    break;
                default :
                    include 'includes/view_all_posts.php';
            }

        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->