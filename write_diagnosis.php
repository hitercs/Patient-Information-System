<?php
	session_start();
?>	
<html>
<header>
	<!-- Bootstrap theme -->
    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap-3.3.5-dist/css/bootstrap.css" rel="stylesheet">
	<!-- Bootstrap theme -->
    <link href="bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
    <link href="mycss/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="mycss/dashboard.css" rel="stylesheet">
	
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="myjs/ie-emulation-modes-warning.js"></script>
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
		if (isset($_GET['PID']) and isset($_SESSION['email']) and isset($_POST['test']) and isset($_POST['patient_DiseaseCate']) and isset($_POST['suggestion']) and isset($_POST['MedicalHis']))
		{
			$read_sql = "SELECT Did from tb_doctors where email='$_SESSION[email]'";
			$re = $conn->query($read_sql);
			if ($re->num_rows > 0)
			{
				$row_ = $re->fetch_assoc();
				$Did = $row_['Did'];
				$sql = "INSERT INTO tb_diagnosis (Pid, Did, test, DiseaseCate, Suggestion, MedicalHis) 
						VALUES ($_GET[PID], $Did, '$_POST[test]', '$_POST[patient_DiseaseCate]', '$_POST[suggestion]', '$_POST[MedicalHis]')";
				$conn->query($sql);
				header("Location: doctorsMain.php");
			}
		}
		//$conn->close();
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
			<form class="margin-bottom-40" role="form" method="post">
				<div class='form-group'>
					<label for='patient_name'>Name</label>
				<?php
					$sql = "SELECT * FROM tb_patients WHERE tb_patients.Pid = $_GET[PID]";
					$re = $conn->query($sql);
					if ($re->num_rows > 0);
					{
						$row = $re->fetch_assoc();
						echo "<input type='text' class='form-control' id='patient_name' readonly='readonly' value=$row[name]>";
					}
				?>
				</div>
				<div class='form-group'>
					<label for='patient_test'>Test</label>
					<input type='text' class='form-control' id='patient_test' name="test">
				</div>
				<div class='form-group'>
					<label for='patient_DiseaseCate'>Disease Category</label>
					<input type='text' id='patient_DiseaseCate' name='patient_DiseaseCate' class='form-control'>
				</div>
				<div class='form-group'>
					<label for='suggestion'>Suggestion</label>
					<input type='text' id='suggestion' name='suggestion' class='form-control'>
				</div>
				<div class='form-group'>
					<label for='MedicalHis'>Medical Histroy</label>
					<input type='text' class='form-control' id='MedicalHis' name='MedicalHis'>
				</div>
				<button type="submit" class="btn-u btn-u-blue">Submit</button>
			</form>
		</div>
	</div>	
</body>
</html>