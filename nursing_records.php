<?php
	session_start();
?>
<html>
<header>
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
	
</body>
</html>