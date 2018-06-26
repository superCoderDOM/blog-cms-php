<section id="forgot-login">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="forgot-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="user_email" placeholder="Email Address" class="form-control" type="email">
                                        </div>
                                        <?php echo isset($email_error) ? "<div class='bg-danger'>{$email_error}</div>" : ""; ?>
                                    </div>

                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <?php echo isset($reset_message) ? $reset_message : ""; ?>

                                </form>
							</div><!-- .panel-body -->
						</div><!-- .text-centre -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->
</section>

