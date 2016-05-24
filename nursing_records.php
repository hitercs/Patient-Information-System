<?php
	session_start();
?>
<html>
<header>
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
	<script>
		$(function() {
			$( "#date" ).datepicker();
		});;
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
          <a class="navbar-brand" href="nursesMain.php">Patients Information System</a>
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
			<form class="margin-bottom-40" role="form" action="<?php echo "nursesMain.php"."?PID=$_GET[PID]"."&NID=$_GET[NID]";?>" method="post">
				<?php
					// query processing 
					$sql = "SELECT tb_patients.name, tb_patients.age, tb_patients.indate, tb_patients.outdate FROM tb_patients WHERE tb_patients.PID = $_GET[PID]";
					$result = $conn->query($sql);
					if ($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc())
						{
							echo "<div class='form-group'>";
							echo "<label for='patient_name'>Name</label>";
							echo "<input type='text' class='form-control' id='patient_name' value='$row[name]' readonly='readonly'>";
							echo "</div>";
							echo "<div class='form-group'>";
							echo "<label for='patient_age'>Age</label>";
							echo "<input type='text' class='form-control' id='patient_age' value='$row[age]' readonly='readonly'>";
							echo "</div>";
							echo "<div class='form-group'>";
							echo "<label for='patient_indate'>Admission time</label>";
							echo "<input type='text' id='patient_indate' name='patient_indate' class='form-control' value='$row[indate]' readonly='readonly'>";
							echo "</div>";
							echo "<div class='form-group'>";
							echo "<label for='patient_outdate'>Discharge time</label>";
							echo "<input type='text' id='patient_outdate' name='patient_outdate' class='form-control' value='$row[outdate]' readonly='readonly'>";
							echo "</div>";
							echo "<div class='form-group'>";
							echo "<label for='patient_state'>State</label>";
							echo "<input type='textarea' id='patient_state' name='patient_State' class='form-control'>";
							echo "</div>";	
							echo "<div class='form-group'>";
							echo "<label for='nurses_evaluation'>Nurses evaluation</label>";
							echo "<input type='textarea' id='nurses_evaluation' name='nurses_evaluation' class='form-control'>";
							echo "</div>";
							echo "<div class='form-group'>";
							echo "<label for='date'>Date</label>";
							echo "<input type='text' id='date' name='date' class='form-control'>";
							echo "</div>";							
						}
					}
					else
					{
						//echo "</br>";
						//echo "No Patients~~";
						//echo "</br>";
					}
					//echo "Connected Close";
					$conn->close();
				?>
				<button type="submit" class="btn-u btn-u-blue">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>