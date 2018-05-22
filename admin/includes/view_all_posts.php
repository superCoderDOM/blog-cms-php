<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th> ID </th>
            <th> Author </th>
            <th> Title </th>
            <th> Category </th>
            <th> Status </th>
            <th> Image </th>
            <th> Tags </th>
            <th> Comments </th>
            <th> Date </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
    </thead>
    <tbody>
        <?php fetchAllPosts(); ?>
        <?php deletePost(); ?>
    </tbody>
</table>
