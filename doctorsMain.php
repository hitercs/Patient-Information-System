<?php
	session_start();
?>
<html>
<header>
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
			// query processing 
			$sql = "SELECT tb_patients.PID FROM tb_doctors, tb_patients WHERE tb_doctors.Did = tb_patients.Did AND tb_doctors.email = '$_SESSION[email]'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0)
			{
				echo "Patients ID:" . "</br>";
				while($row = $result->fetch_assoc())
				{
					echo $row["PID"]."</br>";
				}
			}
			else
			{
				echo "No Patients~~";
			}
			echo "Connected Close";
			$conn->close();
		}
	?>
</header>
<body>

</body>
</html>