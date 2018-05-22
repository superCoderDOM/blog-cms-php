<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th> ID </th>
            <th> Username </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email </th>
            <th> Role </th>
            <th> Admin </th>
            <th> Subscriber </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
    </thead>
    <tbody>
        <?php fetchAllUsers(); ?>
        <?php updateUserRole(); ?>
        <?php deleteUser(); ?>
    </tbody>
</table>
