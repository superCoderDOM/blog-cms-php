<?php 

    // Update Profile Form Handler
    if(isset($_SESSION['username'])) {

        $username = $_SESSION['username'];

        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $selectUserByUsername = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($selectUserByUsername)) {
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];

            updateUser($user_id);

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
                        <option value='subscriber' <?php echo ($user_role === 'subscriber' ? 'selected' : '') ?> >Subscriber</option>
                        <option value='admin' <?php echo ($user_role === 'admin' ? 'selected' : ''); ?> >Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="update_user" class="btn btn-primary" value="Update Profile">
                </div>
            </form>

            <?php
        }
    }
?>
