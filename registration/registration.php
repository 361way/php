<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<link href="" rel="shortcut icon">

	<title>Registration form</title><!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">

</head>

<body>
	<div class="container">
		

		<div class="well">
			<form action="register.php" class="form-horizontal well" method="post">
			<fieldset>
              <legend>Register Now</legend>
			  <h4>It’s free and always will be.</h4>
				 <div class="row">
					
					<div class="col-xs-8">
					<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<div class="col-lg-6">
								<input class="form-control input-lg" id="fName" name="fName" placeholder="First Name" type="text">
							</div>

							<div class="col-lg-6">
								<input class="form-control input-lg" id="lName" name="lName" placeholder="Last Name" type="text">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<div class="col-lg-12">
								<input class="form-control input-lg" id="email" name="email" placeholder="Your Email" type="email">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<div class="col-lg-12">
								<input class="form-control input-lg" id="reemail" name="reemail" placeholder="Re-enter Email" type="text">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<div class="col-lg-12">
								<input class="form-control input-lg" id="password" name="password" placeholder="New Password" type=
								"password">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<h4>
							<div class="col-md-3">
								<label class="col-lg-4 control-label">Birthday</label>
							</div>

							<div class="col-lg-3">
								<select class="form-control input-sm" name="month">
									<option>Month</option>
									<?php
										$m = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
										foreach ($m as $month) {
											echo '<option value='.$month.'>'.$month.'</option>';
										}
									?>
								</select>
							</div>

							<div class="col-lg-3">
								<select class="form-control input-sm" name="day">
									<option>Day</option>
								<?php 
									$d = range(31, 1);
									foreach ($d as $day) {
										echo '<option value='.$day.'>'.$day.'</option>';
									}
								
								?>
									
								</select>
							</div>

							<div class="col-lg-3">
								<select class="form-control input-sm" name="year">
									<option>Year</option>
								<?php 
									$years = range(2020, 1900);
									foreach ($years as $yr) {
										echo '<option value='.$yr.'>'.$yr.'</option>';
									}
								
								?>
								
								</select>
							</div>
							</h4>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="rows">
						<div class="col-md-4">
							<div class="col-lg-6">
								<div class="radio">
									<label><input checked id="optionsRadios1" name="optionsRadios" type="radio" value="Female">Female</label>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="radio">
									<label><input id="optionsRadios2" name="optionsRadios" type="radio" value="Male"> Male</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="rows">
						<div class="col-md-8">
							<div class="col-lg-12">
								<button class="btn btn-success btn-lg" type="submit">Register</button>
							</div>
						</div>
					</div>
				</div>
				
				</div>
					
				</div>	
				</fieldset>
			</form>
		</div>
	</div><!-- /container -->
</body>
</html>
