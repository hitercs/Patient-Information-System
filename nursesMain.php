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
	<script type='text/javascript'>
	var timePeriodInMs = 5000;
	setTimeout(function() 
	{ 
		document.getElementById("texttohide").style.display = "none"; 
	}, 
	timePeriodInMs);
	</script>
		<?php
			function time_format_convert($time1)
			{
				$tmp = explode("/", $time1);
				return $tmp[2].'-'.$tmp[0].'-'.$tmp[1];
			}
		?>
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
		//static $recordsn = 0;
		if (isset($_GET['PID']) and isset($_GET['NID']))
		{
			//save nursing records
			if (strpos($_POST['date'], '/'))
				$new_date = time_format_convert($_POST['date']);
			else
				$new_date = $_POST['date'];
			$insert_sql = "INSERT INTO tb_nursingrecord (evaluation, State, Nid, Pid, date)"."VALUES ('$_POST[nurses_evaluation]', '$_POST[patient_State]', $_GET[NID], $_GET[PID], '$new_date')";
			$conn->query($insert_sql);
			echo "<p id='texttohide'><font color='green'>"."save nursing records successfully"."</font></p>";
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
	<div class="row">
        <div class="col-md-6">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Patients ID</th>
                <th>Patients name</th>
                <th>Admission date</th>
              </tr>
            </thead>
            <tbody>
				<?php
					// query processing 
					$sql = "SELECT tb_patients.PID, tb_patients.name, tb_patients.indate, tb_nurses.Nid FROM tb_nurses, tb_patients WHERE tb_nurses.Nid = tb_patients.Nid AND tb_nurses.email = '$_SESSION[email]'";
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
							echo "<td>"."<form action='nursing_records.php?PID=$row[PID]&NID=$row[Nid]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='write nursing records'>"."</form>"."</td>";
							echo "<td>"."<form action='write_dates.php?PID=$row[PID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='write dates'>"."</form>"."</td>";
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