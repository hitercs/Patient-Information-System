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
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="myjs/ie-emulation-modes-warning.js"></script>
	<h1>Doctors Main Page </h1>
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
			echo "Connected successfully";
		}
	?>
</header>
<body>	
	<div class="page-header">
        <h1>My patients</h1>
    </div>
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
						echo "Patients ID:" . "</br>";
						$n = 0;
						while($row = $result->fetch_assoc())
						{
							echo "<tr>";
							echo "<td>".$n++."</td>";
							echo "<td>".$row["PID"]."</td>";
							echo "<td>".$row["name"]."</td>";
							echo "<td>".$row["indate"]."</td>";
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