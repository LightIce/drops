<?php require_once("header.php");?>
<script src="./js/md5.js"></script>
<script src="./js/system.js"></script>

<div class="container">
	<div class="jumbotron" style="color: white; background-color: #428BCA;" align="center">
		<h1>HDUISA Private Library</h1>
	</div>

	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-inner">
			<!-- HDUISA -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-header">
			<a class="navbar-brand" href="index.php">HDUISA</a>
			</div>

      		<!-- login and singin -->
      		<ul class="nav navbar-nav navbar-right">
      			<li><a href="login.php">Login</a></li>
      			
      			<li><a href="signup.php">Sign up</a></li>	
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

	<div class="panel panel-primary" >
		<div class="panel-heading">
			<h3 class="panel-title">User login</h3>
	    </div>
	  	<div class="panel-body">
	  		<form class="form-horizontal" role="form" action="" method="POST" name="login">
	  			<!-- input -->
	  			<div class="form-group">
	  				<br />
	  				<label for="username" class="col-sm-2 control-label">Username:</label>
	  				<div class="col-sm-9">
	  					<input type="text" class="form-control" id="username" name="username" placeholder="Please input username">
	  				</div>
	  				<br /><br /><br />
	  				<label for="username" class="col-sm-2 control-label">Password:</label>
	  				<div class="col-sm-9">
	  					<input type="password" class="form-control" id="password" name="password" placeholder="Please input password">
	  				</div>
	  			</div>

	  			<!-- button -->
	  			<div class="form-group">
    				<div class="col-sm-offset-4 col-sm-10">
						<button type="button" class="btn btn-success" onclick="SubmitLoginForm()">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        				<!-- <button type="button" class="btn btn-primary"> --><a class="btn btn-primary" href="signup.php">Sign up</a><!-- </button> -->&nbsp;&nbsp;&nbsp;
        				<button type="button" class="btn btn-link">Forget password?</button>
      				</div>

    			</div>

	  		</form>
	   </div> <!-- panel body -->
	</div> <!-- /.panel -->



<?php
	require_once("./config/config.php");

	if (!isset($_POST['username']) || !isset($_POST['password'])) {
		exit;
	}

	$username = SqlGuard($_POST['username'], $db);
	$password = SqlGuard($_POST['password'], $db);

	$query = "SELECT * FROM `tb_drops_users` WHERE DropsUserName = '$username'";
	$result = $db->query($query);

	if (!$result) {
		// no result
		echo "<div class=\"alert alert-danger\" role=\"alert\">Wrong username or password.</div>";
		exit;
	}
	else {
		$rows = $result->num_rows;
		if ($rows != 1) {
			// have more than one result
			echo "<div class=\"alert alert-danger\" role=\"alert\">Wrong username or password.</div>";
			exit;
		}
		$row = $result->fetch_assoc();
		if ($row['DropsUserPassword'] != $password) {
			echo "<div class=\"alert alert-danger\" role=\"alert\">Wrong username or password.</div>";
			exit;
		}
		else {
			// start session
		}

	}

?>



</div><!-- /.container -->
<?php require_once("footer.php");?>