<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th> ID </th>
            <th> Blog Post </th>
            <th> Author </th>
            <th> Email </th>
            <th> Comment </th>
            <th> Status </th>
            <th> Date </th>
            <th> Approve </th>
            <th> Reject </th>
            <th> Delete </th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(isset($_GET['post_id'])) {

                $post_id = mysqli_real_escape_string($connection, $_GET['post_id']);
                fetchCommentsByPostID($post_id);

            } else {

                fetchAllComments();
            }

            updateCommentStatus();
            deleteComment();
         ?>
    </tbody>
</table>
