<?php 

    include "./includes/delete_user_modal.php";

    if(!userIsAdmin($_SESSION['user_id'])) {

        header("Location: index.php");
    }
?>

<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th> ID </th>
            <th> Username </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email </th>
            <th> Role </th>
            <th> Change Role </th>
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

<script src="./js/jquery.js"></script>

<script>
    $(document).ready(function(){
        $(".delete_link").on("click", function(){

            var user_id = $(this).attr("user_id");
            var username = $(this).attr("username");
            $(".modal_delete_username").html(username);
            $("#modal_delete_user_id").attr("value", user_id);
            $("#myModal").modal("show");
        });
    });
</script>