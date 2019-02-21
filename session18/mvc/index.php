
<a href="index.php">Home</a>|
<a href="index.php?requestView=displayListNews">News list</a>|
<a href="index.php?requestView=insertNews">Add News</a>
<a href="index.php?requestView=login">Login</a>
<a href="index.php?requestView=admin">Admin</a>
<?php 
	session_start();
	include 'controller/home_controller.php';
	$controller = new HomeController();
	$controller->handleRequest();
?>