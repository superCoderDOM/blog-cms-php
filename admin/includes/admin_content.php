<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Administration Dashboard
            <small><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?></small>
        </h1>

        <?php include './includes/admin_widgets.php'; ?>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="./index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->