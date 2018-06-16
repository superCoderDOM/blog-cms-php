<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    <?php 

                        if(isset($_POST['submit_registration'])) {

                            $username = $_POST['username'];
                            $user_email = $_POST['email'];
                            $user_password = $_POST['password'];
                            $user_role = 'Subscriber';

                            if(!empty($username) && !empty($user_email) && !empty($user_password)) {

                                // Clean potential malicious SQL injections
                                $username = mysqli_real_escape_string($connection, $username);
                                $user_email = mysqli_real_escape_string($connection, $user_email);
                                $user_password = mysqli_real_escape_string($connection, $user_password);
                                $user_role = mysqli_real_escape_string($connection, $user_role);

                                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                                $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
                                $query .= "VALUES('{$username}', '{$user_email}', '{$hashed_password}', '{$user_role}')";

                                $addUser = mysqli_query($connection, $query);
                                echo "<p class='bg-success'> New user created: {$username} </p>";
                                // header("Location: ./index.php");  // forces page reload

                            } else {

                                echo "<p class='bg-danger'> Fields cannot be empty </p>";
                            }
                        }

                    ?>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" autocomplete="off">
                        </div>
                
                        <input type="submit" name="submit_registration" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                </div> <!-- /.form-wrap -->
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
