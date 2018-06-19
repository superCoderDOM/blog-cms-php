<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">

        <h1 class="page-header"> Categories </h1>

        <!-- Category Forms -->
        <div class="col-xs-6">

            <!-- Create New Category -->
            <?php include './includes/forms/create_category.php'; ?>

            <!-- Update Category -->
            <?php 

                // Update Category Form Handler
                if(isset($_GET['update_cat_id'])) {

                    $cat_id = escape($_GET['update_cat_id']);
                    include './includes/forms/update_category.php';

                }

            ?>

        </div>
        <!-- /.col-xs-6 -->

        <!-- Category Table -->
        <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php fetchAllCategories(); ?>
                    <?php deleteCategory(); ?>
                </tbody>
            </table>
        </div>
        <!-- /.col-xs-6 -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->