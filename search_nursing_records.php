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
	<script type='text/javascript'>
		var timePeriodInMs = 5000;
		setTimeout(function() 
		{ 
			document.getElementById("texttohide").style.display = "none"; 
		}, 
		timePeriodInMs);
	</script>
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
		if (isset($_GET['NursingID']))
		{
			$delete_sql = "DELETE FROM tb_nursingrecord WHERE tb_nursingrecord.ID = '$_GET[NursingID]'";
			$conn->query($delete_sql);
			echo "<p id='texttohide'><font color='green'>"."delete nursing records successfully"."</font></p>";
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
		  <form class="navbar-form navbar-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<input type="text" class="form-control" placeholder="Search by name..." name="pname">
			<input type="text" class="form-control" placeholder="Search by date..." name="date" id="search_date">
			<button type="submit" class="btn-u btn-u-blue">Search</button>
          </form>
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
				<th>Patients Name</th>
                <th>Evaluation</th>
                <th>State</th>
				<th>Date</th>
              </tr>
            </thead>
			<tbody>
				<?php
					$read_sql = "SELECT Nid from tb_nurses where tb_nurses.email='$_SESSION[email]'";
					$re = $conn->query($read_sql);
					$row_ = $re->fetch_assoc();				
					if (isset($_POST['pname']) and isset($_POST['date']))
					{
						if ($_POST['pname'] and !$_POST['date'])
						{
							$search_sql = "SELECT tb_nursingrecord.ID, tb_patients.PID, tb_nursingrecord.evaluation, tb_patients.name, tb_nursingrecord.State, tb_nursingrecord.date FROM tb_nursingrecord, tb_patients WHERE tb_nursingrecord.Pid = tb_patients.PID and tb_patients.name = '$_POST[pname]' AND tb_nursingrecord.Nid = $row_[Nid]";
							$result = $conn->query($search_sql);
						}
						else if (!$_POST['pname'] and $_POST['date'])
						{
							$format_date = time_format_convert($_POST['date']);
							$search_sql = "SELECT tb_nursingrecord.ID, tb_patients.PID, tb_nursingrecord.evaluation, tb_patients.name, tb_nursingrecord.State, tb_nursingrecord.date FROM tb_nursingrecord, tb_patients WHERE tb_nursingrecord.Pid = tb_patients.PID and tb_nursingrecord.date = '$format_date' AND tb_nursingrecord.Nid = $row_[Nid]";
							$result = $conn->query($search_sql);					
						}
						else if ($_POST['pname'] and $_POST['date'])
						{
							$format_date = time_format_convert($_POST['date']);
							$search_sql = "SELECT tb_nursingrecord.ID, tb_patients.PID, tb_nursingrecord.evaluation, tb_patients.name, tb_nursingrecord.State, tb_nursingrecord.date FROM tb_nursingrecord, tb_patients WHERE tb_nursingrecord.Pid = tb_patients.PID and tb_nursingrecord.date = '$format_date' and tb_patients.name = '$_POST[pname]' AND tb_nursingrecord.Nid = $row_[Nid]";
							$result = $conn->query($search_sql);	
						}
						else 
						{
							$search_sql = "SELECT tb_nursingrecord.ID, tb_patients.PID, tb_nursingrecord.evaluation, tb_patients.name, tb_nursingrecord.State, tb_nursingrecord.date FROM tb_nursingrecord, tb_patients WHERE tb_nursingrecord.Pid = tb_patients.PID AND tb_nursingrecord.Nid = $row_[Nid]";
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
								echo "<td>".$row["evaluation"]."</td>";
								echo "<td>".$row["State"]."</td>";
								echo "<td>".$row['date']."</td>";
								echo "<td>"."<form action='search_nursing_records.php?NursingID=$row[ID]' method='post'>"."<input class='btn btn-xs btn-link' type='submit' value='Delete this records'>"."</form>"."</td>";
								echo "</tr>";
							}
						}
					}
				?>
			</tbody>
          </table>
        </div>
	</div>
</body>
</html>