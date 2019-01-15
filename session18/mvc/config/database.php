<?php 
	class ConnectDB {
		function connect_db() {
			$conn = mysqli_connect('127.0.0.1', 'root', 'abc123', '18php06_php');
			if (mysqli_connect_errno()) {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			mysqli_set_charset($conn, "utf8");
			return $conn;
		}
	}
?>