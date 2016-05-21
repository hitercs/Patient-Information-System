<?php
$servername = "573dc08a9d3d2.bj.cdb.myqcloud.com";
$username = "root";
$password = "patient+infor";
$db_name = "test";
$serverPort = "14376";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password, $serverPort);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
	echo "</br>";
	echo "Connecting close";
	$conn = null;
?>
<html>
<body>

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
    echo "Connected successfully";
	echo "</br>";
	echo "Connected Close";
	$conn->close();
?>

</body>
</html>