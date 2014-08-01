<?php require_once("header.php");?>
<script src="./js/md5.js"></script>
<script src="./js/system.js"></script>

<div class="container">
	<!-- title -->
	<div class="jumbotron" style="color: white; background-color: #428BCA;" align="center">
		<h1>HDUISA Private Library</h1>
	</div>

	<!-- navbar -->
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
      			
      			<li><a href="#">Sign up</a></li>	
      		</ul>
			
			<!-- Search -->
			<form class="navbar-form navbar-left" role="search">
        		<div class="form-group">
          		<input type="text" class="form-control" placeholder="search files...">
        		</div>
        		<button type="button" class="btn btn-default">Submit</button>
      		</form>

		</div><!-- /.container-fluid -->
	</nav>


	<div class="panel panel-primary" >
		<div class="panel-heading">
			<h3 class="panel-title">Sign up</h3>
	    </div>
	  	<div class="panel-body">
	  		<form class="form-horizontal" role="form" action="" method="POST" name="signup">
	  			<!-- input -->
	  			<div class="form-group">
	  				<!-- username -->
	  				<br />
	  				<label for="username" class="col-sm-2 control-label"><span style="color:#f00"> * </span>Username:</label>
	  				<div class="col-sm-9">
	  					<input type="text" class="form-control" id="username" name="username" placeholder="Please input username">
	  				</div>
	  				<!-- password -->
	  				<br /><br /><br />
	  				<label for="password" class="col-sm-2 control-label"><span style="color:#f00"> * </span>Password:</label>
	  				<div class="col-sm-9">
	  					<input type="password" class="form-control" id="password" name="password" placeholder="Please input password">
	  				</div>
	  				<!-- Confirm Password -->
	  				<br /><br /><br />
	  				<label for="ConfirmPassword" class="col-sm-2 control-label"><span style="color:#f00"> * </span>Confirm Password:</label>
	  				<div class="col-sm-9">
	  					<input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Please input password again">
	  				</div>
	  				<!-- email -->
	  				<br /><br /><br />
	  				<label for="Email" class="col-sm-2 control-label"><span style="color:#f00"> * </span>Email:</label>
	  				<div class="col-sm-9">
	  					<input type="text" class="form-control" id="email" name="email" placeholder="Please input a vaild email account">
	  				</div>
	  				<!-- invite code -->
	  				<br /><br /><br />
	  				<label for="Invite Code" class="col-sm-2 control-label">Invite Code:</label>
	  				<div class="col-sm-9">
	  					<input type="text" class="form-control" id="InviteCode" name="InviteCode" placeholder="If you do not have a invite code, keep this blank">
	  				</div>	  				
	  			</div> <!-- /.form-group -->

	  			<!-- button -->
	  			<div class="form-group">
    				<div class="col-sm-offset-5 col-sm-5">
						<button type="button" class="btn btn-success" onclick="SubmitForm()">Sign up</button>&nbsp;&nbsp;&nbsp;&nbsp;
        				<!--<button type="button" class="btn btn-primary">Sign up</button>&nbsp;&nbsp;&nbsp;-->
        				<button type="button" class="btn btn-link"><a href="login.php">Already have a account?</a></button>
					</div>
    			</div>

	  		</form>
	   </div> <!-- panel body -->
	</div> <!-- /.panel -->


<?php
	// username
	// password
	// ConfirmPassword
	// email
	// InviteCode
	require_once("config/config.php");
	if (!isset($_POST['username']) || !isset($_POST['password']) || 
		!isset($_POST['ConfirmPassword']) || !isset($_POST['email']) ) {
		exit;
	}
	else {
		// clear the post parament
		$username = SqlGuard($_POST['username'], $db);
		$password = SqlGuard($_POST['password'], $db);
		$ConfirmPassword = SqlGuard($_POST['ConfirmPassword'], $db);
		$email = SqlGuard($_POST['email'], $db);
		if (isset($_POST['InviteCode'])) {
			$InviteCode = SqlGuard($_POST['InviteCode'], $db);
			$isInvited = 1;
		}
		else $isInvited = 0;

		// TODO: check username if exists
		// 		 check Invite code if vaild
		$query = "SELECT * FROM `tb_drops_users` WHERE DropsUserName = '$username'";
		$QueryResult = $db->query($query);
		$rows = $QueryResult->num_rows;
		if ($rows != 0) {
			echo "<div class=\"alert alert-danger\">The username '$username' is already exists</div>";
			exit;
		}
		
		// check the password if same
		// check in client first!!!
		if (md5($password) != md5($ConfirmPassword)) {
			echo "<div class=\"alert alert-danger\">The password you input doesn't match.</div>";
			exit;
		}

		// check if email vaild		
		if (!preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $email)) {
			echo "<div class=\"alert alert-danger\">Please input a valid email.</div>";
			exit;
		}
		
		// check invite code if valid,
		// For debug . allow all invite code
		if (!checkInviteCode($InviteCode)) {
			echo "<div class=\"alert alert-danger\">Invalid invite code.</div>";
			$vip = 0;
			exit;
		}
		else $vip = 1;

		$id = "";

		// insert into database
		$stmt = $db->prepare("INSERT INTO `tb_drops_users` (DropsUserID, DropsUserPassword, DropsUserName, DropsUserVIP) VALUES (?,?,?,?)");
		$stmt->bind_param("issi", $id, $password, $username, $vip);
		$affectRows = $stmt->execute();

		// check if sign up success.
		if ($affectRows == 1) {
			echo "<div class=\"alert alert-success\">Sign up success. Go to home page in 3s or <a href=\"index.php\">CLICK ME</a></div>";
			echo "<script>DelayURL('index.php', 3000)</script>";
			exit;
		}
		else {
			echo "<div class=\"alert alert-danger\">Something going wrong. Please try later.</div>";
			exit;
		}
		

	}
?>

</div> <!-- /.container -->
<?php require_once("footer.php");?>

<?php
	
	function checkInviteCode($InviteCode) {
		return true;
	}


?>


