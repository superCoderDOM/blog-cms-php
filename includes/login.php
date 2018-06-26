<section id="login">
	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">

							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">

								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											<input name="user_email" type="text" class="form-control" placeholder="Enter Email">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="user_password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">
										<input name="login" class="btn btn-lg btn-primary btn-block" value="login" type="submit">
									</div>

									<div class="form-group"><a href="./forgot.php?forgot=<?php echo uniqid(true); ?>"> Forgot your password? </a></div>

								</form>
							</div><!-- .panel-body -->
						</div><!-- .text-centre -->
					</div><!-- .panel-body -->
				</div><!-- .panel -->
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->
</section>
