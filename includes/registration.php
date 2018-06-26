<section id="registration">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    <?php $errors = registerUser() ?>
                    <form role="form" action="" method="post" id="registration-form" autocomplete="on">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" 
                                placeholder="Enter Desired Username" 
                                value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                            <?php echo isset($errors['username']) ? "<p class='bg-danger'> {$errors['username']} </p>" : ""; ?>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                placeholder="somebody@example.com"
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            <?php echo isset($errors['email']) ? "<p class='bg-danger'> {$errors['email']} </p>" : ""; ?>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" autocomplete="off">
                            <?php echo isset($errors['password']) ? "<p class='bg-danger'> {$errors['password']} </p>" : ""; ?>
                        </div>
                
                        <input type="submit" name="submit_registration" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                    </form>
                </div> <!-- /.form-wrap -->
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
