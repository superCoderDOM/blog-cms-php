<?php 

    if(isset($_POST['checkBoxArray'])) {

        foreach(escape($_POST['checkBoxArray']) as $post_id) {

            $bulk_option = escape($_POST['bulk_option']);

            switch($bulk_option) {
                case 'Published':
                    updatePostStatus($post_id, $bulk_option);
                    break;

                case 'Draft':
                    updatePostStatus($post_id, $bulk_option);
                    break;

                case 'Delete':
                    deletePostWithID($post_id);
                    break;

                case 'Clone':
                    clonePostWithID($post_id);
                    break;
            }
        }
    }

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div class="col-xs-4" id="bulkOptionContainer">
            <select class="form-control" name="bulk_option" id="bulk_option">
                <option value="">Select Option</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
                <option value="Clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" class="btn btn-success" name="submit_bulk_option" value="Apply">
            <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
        </div>

        <thead class="thead-dark">
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th> ID </th>
                <th> Author </th>
                <th> Title </th>
                <th> Category </th>
                <th> Status </th>
                <th> Image </th>
                <th> Tags </th>
                <th> Views </th>
                <th> Comments </th>
                <th> Date </th>
                <th> View Post </th>
                <th> Edit </th>
                <th> Delete </th>
                <th> Reset Views </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(isset($_GET['author_id'])) {

                    $author_id = escape($_GET['author_id']);
                    fetchPostsByAuthorID($author_id);

                } else {

                    fetchAllPosts();
                }
                deletePost();
                resetPostViews();
            ?>
        </tbody>
    </table>
</form>
