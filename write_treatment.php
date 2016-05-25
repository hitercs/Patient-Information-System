<?php
	session_start();
?>
<html>
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="patientsMain.php">Patients Information System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
			<li>
				<a href="#">
				<?php
					if (isset($_SESSION['email']))
				      {
							echo "hello, ". $_SESSION['email'];
					  }
					  else
					  {
							echo "hello, Guest";
					  }
				?>
				</a>
			</li>
          </ul>
        </div>
      </div>
    </nav>	
	<!-- Bootstrap theme -->
	<link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="mycss/app.css" rel="stylesheet">
	<link href="mycss/style.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="mycss/theme.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="mycss/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="mycss/jquery-ui.css">
	<script src="myjs/jquery-1.10.2.js"></script>
	<script src="myjs/jquery-ui.js"></script>
    <?php
		if (!isset($_SESSION["email"]))
		{
			$error_msg = "Request Forbidden！Please Log in first\n";
			trigger_error($error_msg);
		}
		else
		{
			//connect database
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
			//echo "Connected successfully";
		}
    ?>
	<?php
		if(isset($_GET['PID']) and isset($_SESSION['email']) and isset($_POST['in_hospital']) and isset($_POST['is_operation']) and isset($_POST['treatment'])) 
		{
			$read_sql = "SELECT Did from tb_doctors where email='$_SESSION[email]'";
			$re = $conn->query($read_sql);
			if ($re->num_rows > 0)
			{
				$row_ = $re->fetch_assoc();
				$Did = $row_['Did'];
				$sql = "INSERT INTO tb_treatment (patient_id, doctor_id, InHospital, IsOperation, remarks) 
					VALUES ($_GET[PID], $Did, $_POST[in_hospital], $_POST[is_operation] , '$_POST[treatment]');";
				$result = $conn->query($sql);
				$sql = "SELECT * FROM tb_treatment ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql);	
				$tid = $result->fetch_assoc()["id"];
				$sql = "INSERT INTO tb_prescription (Tid, drug, dosage) VALUES 
				($tid, '$_POST[drug]', '$_POST[dosage]')";
				$conn->query($sql);
				header("Location: doctorsMain.php");
			}
		}
		$conn->close();
    ?>
</header>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="doctorsMain.php">Patients Information System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
			<li>
				<a href="#">
				<?php
					if (isset($_SESSION['email']))
				      {
							echo "hello, ". $_SESSION['email'];
					  }
					  else
					  {
							echo "hello, Guest";
					  }
				?>
				</a>
			</li>
          </ul>
        </div>
      </div>
    </nav>	
	<!-- Basic Form -->
	<div class="panel panel-blue margin-bottom-40">
		<div class="panel-body">
			<form class="margin-bottom-40" role="form" action="<?php echo $_SERVER['PHP_SELF']."?PID=$_GET[PID]";?>" method="post">
				<div class='form-group'>
					<label for="treatment">Treatment</label>
					<input type="text" class="form-control" name="treatment" id="treatment" placeholder="Treatment" required autofocus>
				</div>
				<div class='form-group'>
					<label for="is_operation">Is Operation</label>
					<select name='is_operation' id='is_operation'>
						<option value=0>No</option>
						<option value=1>Yes</option>
					</select>
				</div>
				<div class='form-group'>
					<label for="in_hospital">In Hospital</label>
					<select name='in_hospital' id='in_hospital'>
						<option value=0>No</option>
						<option value=1>Yes</option>
					</select>
				</div>
				<div class='form-group'>
					<label for="drug">Drug</label>
					<input type="text" class="form-control" name="drug" id="drug" placeholder="Drug" required autofocus>
				<div class='form-group'>
				<div class='form-group'>
					<label for="dosage">Dosage</label>
					<input type="text" class="form-control" name="dosage" id="dosage" placeholder="Dosage" required autofocus>
				</div class='form-group'>
				<button type="submit" class="btn-u btn-u-blue">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>