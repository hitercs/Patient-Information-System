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
	<script>
	$(function() {
		$( "#search_date" ).datepicker();
	});
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
		  <form class="navbar-form navbar-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<input type="text" class="form-control" placeholder="Search by name..." name="pname">
			<select name="type">
				<option value='0' selected>symptom</option>
				<option value='1'>diagnosis</option>
				<option value='2'>treatment plan</option>
			</select>
			<button type="submit" class="btn-u btn-u-blue">Search</button>
          </form>
        </div>
      </div>
    </nav>	
	<div class="row">
        <div class="col-md-6">
          <table class="table table-striped">
			<?php
				if (isset($_POST['pname']) and isset($_POST['type']))
				{
					$read_sql = "SELECT Did from tb_doctors where email='$_SESSION[email]'";
					$re = $conn->query($read_sql);
					if ($_POST['type'] == '0')
					{
						//show symptom
						echo " <thead>
								  <tr>
									<th>#</th>
									<th>PID</th>
									<th>Name</th>
									<th>Symptom</th>
									<th>Complain</th>
									<th>Recorded time</th>
								  </tr>
								</thead>";
						if ($re->num_rows > 0)
						{
							$row_ = $re->fetch_assoc();
							if ($_POST['pname'])
							{
								$search_sql = "SELECT tb_symptom.PID, tb_patients.name,tb_symptom.symptom, tb_symptom.complain, tb_symptom.recorded_on FROM tb_symptom, tb_patients WHERE tb_symptom.PID = tb_patients.PID and tb_patients.name='$_POST[pname]' and tb_symptom.DID = $row_[Did]";
								$result = $conn->query($search_sql);
							}
							else
							{
								$search_sql = "SELECT tb_symptom.PID, tb_patients.name,tb_symptom.symptom, tb_symptom.complain, tb_symptom.recorded_on FROM tb_symptom, tb_patients WHERE tb_symptom.PID = tb_patients.PID and tb_symptom.DID = $row_[Did]";
								$result = $conn->query($search_sql);	
							}
							if ($result->num_rows > 0)
							{
								$m = 1;
								while ($row = $result->fetch_assoc())
								{
									echo "<tr>";
									echo "<td>".$m++."</td>";
									echo "<td>".$row["PID"]."</td>";
									echo "<td>".$row["name"]."</td>";
									echo "<td>".$row["symptom"]."</td>";
									echo "<td>".$row["complain"]."</td>";
									echo "<td>".$row["recorded_on"]."</td>";
									//echo "<td>"."<form action='search_nursing_records.php?NursingID=$row[ID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='Delete this records'>"."</form>"."</td>";
									echo "</tr>";
								}
							}	
						}	
					}
					else if ($_POST['type']=='1')
					{
						//diagnosis
						echo " <thead>
								  <tr>
									<th>#</th>
									<th>PID</th>
									<th>Name</th>
									<th>Test</th>
									<th>Disease Category</th>
									<th>Suggestion</th>
									<th>Medical Histroy</th>
									<th>Recorded time</th>
								  </tr>
								</thead>";
						if ($re->num_rows >0)
						{
							$row_ = $re->fetch_assoc();
							if ($_POST['pname'])
							{
								$search_sql = "SELECT tb_patients.name, tb_diagnosis.Pid, tb_diagnosis.Test, tb_diagnosis.DiseaseCate, tb_diagnosis.Suggestion, tb_diagnosis.MedicalHis, tb_diagnosis.recorded_on FROM tb_diagnosis, tb_patients WHERE tb_diagnosis.Pid = tb_patients.PID AND tb_diagnosis.Did = $row_[Did] AND tb_patients.name = '$_POST[pname]'";
								$result = $conn->query($search_sql);	
							}
							else 
							{
								$search_sql = "SELECT tb_patients.name, tb_diagnosis.Pid, tb_diagnosis.Test, tb_diagnosis.DiseaseCate, tb_diagnosis.Suggestion, tb_diagnosis.MedicalHis, tb_diagnosis.recorded_on FROM tb_diagnosis, tb_patients WHERE tb_diagnosis.Pid = tb_patients.PID AND tb_diagnosis.Did = $row_[Did]";
								$result = $conn->query($search_sql);	
							}
							if ($result->num_rows > 0)
							{
								$m = 1;
								while ($row = $result->fetch_assoc())
								{
									echo "<tr>";
									echo "<td>".$m++."</td>";
									echo "<td>".$row["Pid"]."</td>";
									echo "<td>".$row["name"]."</td>";
									echo "<td>".$row["Test"]."</td>";
									echo "<td>".$row["DiseaseCate"]."</td>";
									echo "<td>".$row["Suggestion"]."</td>";
									echo "<td>".$row["MedicalHis"]."</td>";
									echo "<td>".$row["recorded_on"]."</td>";
									//echo "<td>"."<form action='search_nursing_records.php?NursingID=$row[ID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='Delete this records'>"."</form>"."</td>";
									echo "</tr>";
								}
							}							
						}
					}
					else if ($_POST['type']=='2')
					{
						//treatment plan 
						echo " <thead>
								  <tr>
									<th>#</th>
									<th>PID</th>
									<th>Name</th>
									<th>In hospital</th>
									<th>Is operation</th>
									<th>Remarks</th>
									<th>Recorded time</th>
								  </tr>
								</thead>";
						if ($re->num_rows >0)
						{
							$row_ = $re->fetch_assoc();
							if ($_POST['pname'])
							{
								$search_sql = "SELECT tb_patients.PID, tb_patients.name, tb_treatment.InHospital, tb_treatment.IsOperation, tb_treatment.Remarks, tb_treatment.recorded_on FROM tb_patients, tb_treatment WHERE tb_patients.name='$_POST[pname]' and tb_treatment.patient_id=tb_patients.PID and tb_treatment.doctor_id=$row_[Did]";
								$result = $conn->query($search_sql);	
							}	
							else
							{
								$search_sql = "SELECT tb_patients.PID, tb_patients.name, tb_treatment.InHospital, tb_treatment.IsOperation, tb_treatment.Remarks, tb_treatment.recorded_on FROM tb_patients, tb_treatment WHERE tb_treatment.patient_id=tb_patients.PID and tb_treatment.doctor_id=$row_[Did]";
								$result = $conn->query($search_sql);								
							}
							if ($result->num_rows > 0)
							{
								$m = 1;
								while ($row = $result->fetch_assoc())
								{
									echo "<tr>";
									echo "<td>".$m++."</td>";
									echo "<td>".$row["PID"]."</td>";
									echo "<td>".$row["name"]."</td>";
									if ($row['InHospital'] == 0)
										echo "<td>"."yes"."</td>";
									else if ($row['InHospital'] == 1)
										echo "<td>"."no"."</td>";
									if ($row['IsOperation'] == 0)
										echo "<td>"."yes"."</td>";
									else if ($row['IsOperation'] == 1)
										echo "<td>"."no"."</td>";
									//echo "<td>"."<form action='search_nursing_records.php?NursingID=$row[ID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='Delete this records'>"."</form>"."</td>";
									echo "<td>".$row["Remarks"]."</td>";
									echo "<td>".$row["recorded_on"]."</td>";
									echo "</tr>";
								}
							}	
						}
					}
				}
			?>
          </table>
        </div>
	</div>
</body>
</html>