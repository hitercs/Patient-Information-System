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
	<div class="row">
        <div class="col-md-6">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Patients ID</th>
                <th>Patients name</th>
                <th>In date</th>
              </tr>
            </thead>
            <tbody>
				<?php
					// query processing 
					$sql = "SELECT tb_patients.PID, tb_patients.name, tb_patients.indate FROM tb_doctors, tb_patients WHERE tb_doctors.Did = tb_patients.Did AND tb_doctors.email = '$_SESSION[email]'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0)
					{
						$n = 1;
						//patients list
						while($row = $result->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$n++."</td>";
							echo "<td>".$row["PID"]."</td>";
							echo "<td>".$row["name"]."</td>";
							echo "<td>".$row["indate"]."</td>";
							echo "<td>"."<form action='doctors_view_infor.php?PID=$row[PID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='view information'>"."</form>"."</td>";
							echo "<td>"."<form action='write_symptom.php?PID=$row[PID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='write symptom'>"."</form>"."</td>";
							echo "<td>"."<form action='write_diagnosis.php?PID=$row[PID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='write diagnosis'>"."</form>"."</td>";
							echo "<td>"."<form action='write_treatment.php?PID=$row[PID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='write treatment plan'>"."</form>"."</td>";
							echo "</tr>";
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
            </tbody>
          </table>
        </div>
	</div>
</body>
</html>