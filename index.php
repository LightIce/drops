<?php require_once("./header.php"); ?>

<div class="container">
	<div class="jumbotron" style="color: white; background-color: #428BCA;" align="center">
		<h1>HDUISA Private Library</h1>
	</div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-inner">
			<!-- HDUISA -->

			<div class="navbar-header">
			<a class="navbar-brand" href="#">HDUISA</a>
			</div>

      		<!-- login and signin -->
      		<?php
      			if (!isset($_SESSION['session_id']) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
      				echo <<< HTML
						<ul class="nav navbar-nav navbar-right">
							<li><a href="login.php">Login</a></li>
							<li><a href="signup.php">Sign up</a></li>	
						</ul>
HTML;
      			}
      			else {
      				$user_name = $_SESSION['user_name'];
      				echo <<< HTML
      				<ul class="nav navbar-nav navbar-right">
      				<li><a href="#">Welcome, $user_name</a></li>
      				<li><a href="logout.php">Logout</a></li>
      				</ul>
HTML;
      			}
      		?>
			
			<!-- Search -->
			<form class="navbar-form navbar-left" role="search">
        		<div class="form-group">
          		<input type="text" class="form-control" placeholder="search files...">
        		</div>
        		<button type="submit" class="btn btn-default">Submit</button>
      		</form>

		</div><!-- /.container-fluid -->
	</nav>

	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Newest files
					</h3>
				</div>
			</div> <!-- /.panel -->
		</div>
		<div class="col-xs-6 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Download list
					</h3>
				</div>
			</div> <!-- /.panel -->
		</div>
	</div> <!-- /.row -->




</div><!-- /.container -->
<?php require_once("./footer.php"); ?>
