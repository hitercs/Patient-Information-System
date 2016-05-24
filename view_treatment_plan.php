<?php
	session_start();
?>
<html>
<header>
	<!-- Bootstrap theme -->
    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
    <link href="bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
    <link href="mycss/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="mycss/dashboard.css" rel="stylesheet">
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
	<!-- Basic Form -->
	<div class="panel panel-blue margin-bottom-40">
		<div class="panel-body">
			<form class="margin-bottom-40" role="form" method="post">
				<?php
					$sql = "SELECT tb_treatment.InHospital, tb_treatment.IsOperation, tb_treatment.Remarks, tb_treatment.recorded_on FROM tb_patients, tb_treatment WHERE tb_patients.email = '$_SESSION[email]' and tb_treatment.patient_id=tb_patients.PID";
					$result = $conn->query($sql);
					if ($result->num_rows > 0)
					{
						$row = $result->fetch_assoc();
						echo "<div class='form-group'>";
						echo "<label for='patient_name'>Name</label>";
						echo "<input type='text' class='form-control' id='patient_name' value='$row[name]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_test'>Test</label>";
						echo "<input type='text' class='form-control' id='patient_test' value='$row[Test]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_DiseaseCate'>Disease Category</label>";
						echo "<input type='text' id='patient_DiseaseCate' name='patient_DiseaseCate' class='form-control' value='$row[DiseaseCate]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='suggestion'>Suggestion</label>";
						echo "<input type='text' id='suggestion' name='suggestion' class='form-control' value='$row[suggestion]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='MedicalHis'>Medical Histroy</label>";
						echo "<input type='text' class='form-control' id='MedicalHis' value='$row[MedicalHis]' name='MedicalHis' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='recorded_on'>Time</label>";
						echo "<input type='text' class='form-control' id='recorded_on' value='$row[recorded_on]' name='recorded_on' readonly='readonly'>";
						echo "</div>";
					}
				?>
			</form>
		</div>
	</div>	
</body>
</html>