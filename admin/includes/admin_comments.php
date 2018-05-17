<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">

        <h1 class="page-header"> Comments </h1>

        <?php 

            if(isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = '';
            }

            // Display only requested posts
            switch($source) {
                case 'approve_comment' :
                    include 'includes/forms/approve_comment.php';
                    break;
                case 'unapprove_comment' :
                    include 'includes/forms/reject_comment.php';
                    break;
                default :
                    include 'includes/view_all_comments.php';
            }

        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->