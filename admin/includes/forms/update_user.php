<?php 

    // Update User Form Handler
    if(isset($_GET['edit_user_id'])) {

        $user_id = $_GET['edit_user_id'];

        updateUser($user_id);

        $query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $selectUserByID = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selectUserByID)) {

            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];

            ?>

            <!-- Edit User Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user_firstname">First Name</label>
                    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                </div>
                <div class="form-group">
                    <label for="user_lastname">Last Name</label>
                    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                </div>
                <div class="form-group">
                    <label for="user_role">Role</label>
                    <select name="user_role" id="user_role" class="form-control">
                        <option value='Subscriber' <?php echo ($user_role === 'Subscriber' ? 'selected' : '') ?> >Subscriber</option>
                        <option value='Admin' <?php echo ($user_role === 'Admin' ? 'selected' : ''); ?> >Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="update_user" class="btn btn-primary" value="Update User">
                </div>
           </form>

            <?php
        }
    }
?>
