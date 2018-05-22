<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">

        <h1 class="page-header"> Users </h1>

        <?php

            if(isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = '';
            }

            // Display only requested posts
            switch($source) {
                case 'add_user' :
                    include 'includes/forms/create_user.php';
                    break;
                case 'edit_user' :
                    include 'includes/forms/update_user.php';
                    break;
                default :
                    include 'includes/view_all_users.php';
            }

        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->