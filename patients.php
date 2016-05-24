<?php
	session_start();
?>
<html>
<header>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	 <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="mycss/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="myjs/ie-emulation-modes-warning.js"></script>
	<style type="text/css">
		p {
				text-align: center
		  }
	</style>
	<script type='text/javascript'>
		var timePeriodInMs = 5000;
		setTimeout(function() 
		{ 
			document.getElementById("texttohide").style.display = "none"; 
		}, 
		timePeriodInMs);
	</script>
	<?php
	    $serverName = "573dc08a9d3d2.bj.cdb.myqcloud.com";
		$serverPort = "14376";
		$password = "patient+infor";
		$username = "root";
		$db_name = "test";
		$conn = new mysqli($serverName, $username, $password, $db_name, $serverPort);
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		//$conn->close();
	?>
	<?php
		if (isset($_POST['email']) and isset($_POST['password']))
		{
			$search_sql = "SELECT tb_patients.password, tb_patients.PID FROM tb_patients WHERE tb_patients.email='$_POST[email]'";
			$result = $conn->query($search_sql);
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				if ($row['password'] == substr(hash("sha256", $_POST['password']), 0, 15))
				{
					$_SESSION['email'] = $_POST['email'];
					header("Location: patientsMain.php?PID=$row[PID]");
				}
				else
				{
					echo "<p id='texttohide'><font color='red'>"."password wrong, enter again!"."</font></p>";
				}
			}
		}
		$conn->close();
	?>
</header>
    <div class="container">
      <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h2 class="form-signin-heading">Welcome to Patients information System!</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>	
</html>