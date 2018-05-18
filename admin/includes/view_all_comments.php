<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th> Id </th>
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
        <?php fetchAllComments(); ?>
        <?php updateCommentStatus(); ?>
        <?php deleteComment(); ?>
    </tbody>
</table>
