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
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="myjs/ie-emulation-modes-warning.js"></script>
	<link rel="stylesheet" href="mycss/jquery-ui.css">
	<script src="myjs/jquery-1.10.2.js"></script>
	<script src="myjs/jquery-ui.js"></script>
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
		//echo "Connected successfully";
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
			<form class="margin-bottom-40" role="form">
				<?php
					$sql = "SELECT * FROM tb_patients WHERE tb_patients.Pid = $_GET[PID]";
					$result = $conn->query($sql);
					if ($result->num_rows > 0)
					{
						$row = $result->fetch_assoc();
						echo "<div class='form-group'>";
						echo "<label for='patient_name'>Name</label>";
						echo "<input type='text' class='form-control' id='patient_name' value='$row[name]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_email'>Email</label>";
						echo "<input type='text' class='form-control' id='patient_email' value='$row[email]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_indate'>indate</label>";
						echo "<input type='text' id='patient_indate' name='patient_indate' class='form-control' value='$row[indate]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_outdate'>outdate</label>";
						echo "<input type='text' id='patient_outdate' name='patient_outdate' class='form-control' value='$row[outdate]' readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_age'>Age</label>";
						echo "<input type='text' class='form-control' id='patient_age' value='$row[age]' name='patient_age'  readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='patient_addr'>Addr</label>";
						echo "<input type='text' class='form-control' id='patient_addr' value='$row[addr]' name='patient_addr'  readonly='readonly'>";
						echo "</div>";
						echo "<div class='form-group'>";
						echo "<label for='isMarry'>isMarry</label>";
						echo "<select name='isMarry' id='isMarry' value='$row[Married]'  readonly='readonly'>";
						if ($row['Married'] == 0)
						{
							echo "<option value='0' selected>no</option>";
						}
						else
						{
							echo "<option value='1' selected>yes</option>";
						}	
						echo "</select>"."</div>";
						echo "<div class='form-group'>";
						echo "<label for='gender'>Gender</label>";
						echo "<select name='gender' id='gender'  readonly='readonly'>";
						if ($row['gender'] == 0)
						{
							echo "<option value='0' selected>M</option>";
						}	
						else if($row['gender'] == 1)
						{
							echo "<option value='1' selected>F</option>";
						}	
						else
						{					
							echo "<option value='2' selected>Other</option>";
						}
						echo "</select>"."</div>";
					}
				?>
			</form>
		</div>
	</div>	
</body>
</html>