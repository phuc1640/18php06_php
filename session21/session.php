<?php 
	session_start();
	$_SESSION['name'] = "Hello";
	echo $_SESSION['name'];	
?>