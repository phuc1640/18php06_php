<?php
	function connectDb() {
		$servername = "localhost";
		$username = "root";
		$password = "abc123";
		$dbname = "18php06_php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		mysqli_set_charset($conn, 'uft8');
		return $conn;
	}
	?>