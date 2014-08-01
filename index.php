<?php require_once("./header.php"); ?>

<div class="container">
	<div class="jumbotron" style="color: white; background-color: #428BCA;">
		<h1>Welcome to HDUISA Private Library</h1>
	</div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-inner">
			<!-- HDUISA -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-header">
			<a class="navbar-brand" href="#">HDUISA</a>
			</div>

      		<!-- login and singin -->
      		<ul class="nav navbar-nav navbar-right">
      			<li><a href="login.php">Login</a></li>
      			
      			<li><a href="Signup.php">Sign up</a></li>	
      		</ul>
			
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
